<?php

function admin_dashboard() {
    require_admin();

    // Récupérer les stats depuis le modèle
    $stats = get_dashboard_stats();

    // Charger la vue
    include __DIR__ . '/../views/admin/dashboard.php';
}

// ----------------- GESTION DES MÉDIAS -----------------
function admin_media_list()
{
    // Vérifie les droits د'administrateur
    require_admin();
    // Récupère tous les médias
    $medias = get_all_media();
    // Affiche la liste des médias
    load_view_with_layout('admin/media_list', ['medias' => $medias]);
}

function admin_media_edit($id = null)
{
    // Vérifie les droits د'administrateur
    require_admin();
    // Initialisation de la variable média
    $media = null;
    if ($id) {
        // Sépare l'ID en type و identifiant
        $parts = explode('_', $id);
        if (count($parts) === 2) {
            $type = $parts[0];
            $media_id = $parts[1];
            $media = get_media_by_id($media_id, $type);
            if ($media) {
                $media['media_type'] = $type;
            }
        }
    }
    // Affiche le formulaire d'édition ou de création
    load_view_with_layout('admin/media_edit', ['media' => $media, 'title' => $id ? 'Éditer média' : 'Ajouter média']);
}

/**
 * Enregistre un média (création ou mise à jour)
 */
function admin_media_save($id = null)
{
    require_admin();
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Token CSRF invalide');
        redirect($id ? "/admin/media/edit/$id" : "/admin/media/add");
        return;
    }
    $title = trim($_POST['title'] ?? '');
    $type = $_POST['type'] ?? '';
    $genre = trim($_POST['genre'] ?? '');
    $stock = intval($_POST['stock'] ?? 1);
    $type_map = ['livre' => 'book', 'film' => 'movie', 'jeu' => 'video_game'];
    $type_db = $type_map[$type] ?? $type;
    if (!in_array($type_db, ['book', 'movie', 'video_game'])) {
        set_flash('error', 'Type de média invalide');
        redirect($id ? "/admin/media/edit/$id" : "/admin/media/add");
        return;
    }
    $extra_fields = ['title' => $title, 'genre' => $genre, 'stock' => $stock];
    if ($type_db === 'book') {
        $extra_fields['writer'] = trim($_POST['writer'] ?? '');
        $extra_fields['ISBN13'] = trim($_POST['ISBN13'] ?? '');
        $extra_fields['page_number'] = intval($_POST['page_number'] ?? 0);
        $extra_fields['synopsis'] = trim($_POST['synopsis'] ?? '');
        $extra_fields['year'] = intval($_POST['year'] ?? 0);
    } elseif ($type_db === 'movie') {
        $extra_fields['producer'] = trim($_POST['producer'] ?? '');
        $extra_fields['duration_m'] = intval($_POST['duration_m'] ?? 0);
        $extra_fields['synopsis'] = trim($_POST['synopsis'] ?? '');
        $extra_fields['classification'] = trim($_POST['classification'] ?? '');
        $extra_fields['year'] = intval($_POST['year'] ?? 0);
    } elseif ($type_db === 'video_game') {
        $extra_fields['editor'] = trim($_POST['editor'] ?? '');
        $extra_fields['platform'] = trim($_POST['platform'] ?? '');
        $extra_fields['min_age'] = intval($_POST['min_age'] ?? 0);
        $extra_fields['synopsis'] = trim($_POST['synopsis'] ?? '');
        $extra_fields['year'] = intval($_POST['year'] ?? 0);
    }
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = upload_cover_image($_FILES['image']);
        if ($image_name) {
            $extra_fields['image_url'] = $image_name;
        }
    }
    if (empty($title) || empty($genre) || $stock < 0) {
        set_flash('error', 'Champs obligatoires manquants ou invalides.');
        redirect($id ? "/admin/media/edit/$id" : "/admin/media/add");
        return;
    }
    if ($id) {
        $parts = explode('_', $id);
        if (count($parts) === 2) {
            $type_db = $parts[0];
            $media_id = $parts[1];
            $media = get_media_by_id($media_id, $type_db);

            // Si une nouvelle image est uploadée, supprimer l'ancienne
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                if ($media && !empty($media['image_url'])) {
                    $file_path = PUBLIC_PATH . '/assets/images/' . $media['image_url'];
                    if (file_exists($file_path)) unlink($file_path);
                }
                $image_name = upload_cover_image($_FILES['image']);
                if ($image_name) {
                    $extra_fields['image_url'] = $image_name;
                }
            }
            update_media($media_id, $type_db, $extra_fields);
            set_flash('success', 'Média mis à jour avec succès.');
        }
    } else {
        create_media($type_db, $extra_fields);
        set_flash('success', 'Média créé avec succès.');
    }
    redirect('/admin/media');
}

/**
 * Supprime un média
 */
function admin_media_delete($id, $type)
{
    require_admin();
    $type_map = ['livre' => 'book', 'film' => 'movie', 'jeu' => 'video_game'];
    $type_db = $type_map[$type] ?? $type;

    // Vérifier s'il y a des emprunts en cours
    $active_loans = db_select_one(
        "SELECT COUNT(*) as total FROM loans WHERE media_id = ? AND media_type = ? AND returned_at IS NULL",
        [$id, $type_db]
    );
    if (($active_loans['total'] ?? 0) > 0) {
        set_flash('error', 'Impossible de supprimer ce média : emprunts en cours.');
        redirect('/admin/media');
        return;
    }

    // Suppression physique de l'image
    $media = get_media_by_id($id, $type_db);
    if ($media && !empty($media['image_url'])) {
        $file_path = PUBLIC_PATH . '/assets/images/' . $media['image_url'];
        if (file_exists($file_path)) unlink($file_path);
    }

    // Suppression en base
    if (in_array($type_db, ['book', 'movie', 'video_game']) && delete_media($id, $type_db)) {
        set_flash('success', 'Média supprimé avec succès.');
    } else {
        set_flash('error', 'Impossible de supprimer ce média.');
    }
    redirect('/admin/media');
}

// ----------------- GESTION DES UTILISATEURS -----------------
function admin_users_list()
{
    // Vérifie les droits د'administrateur
    require_admin();
    // Récupère tous les utilisateurs
    $users = get_all_users();
    // Affiche la liste des utilisateurs
    load_view_with_layout('admin/users_list', ['users' => $users]);
}

function admin_user_detail($id)
{
    require_admin();

    // Récupérer les infos utilisateur
    $user = get_user_by_id($id);
    if (!$user) {
        set_flash('error', 'Utilisateur introuvable.');
        redirect('/admin/users');
        return;
    }

    // Stats emprunts
    $all_loans = get_user_loans($id) ?: [];
    $user['total_loans'] = count($all_loans);
    $user['active_loans'] = count_active_loans($id) ?? 0;
    $user['overdue_loans'] = get_user_overdue_loans($id) ?: [];

    // Affiche la vue
    load_view_with_layout('admin/user_detail', [
        'user' => $user,
        'loans' => $all_loans
    ]);
}



// ----------------- GESTION DES EMPRUNTS -----------------
function admin_loans_list()
{
    // Vérifie les droits د'administrateur
    require_admin();
    // Récupère tous les emprunts
    $loans = get_all_loans();
    // Affiche la liste des emprunts
    load_view_with_layout('admin/loans_list', ['loans' => $loans]);
}

function admin_loan_return($loan_id)
{
    // Vérifie les droits د'administrateur
    require_admin();
    // Marque ل'emprunt comme rendu
    if (return_loan($loan_id)) {
        set_flash('success', 'Emprunt marqué comme rendu.');
    } else {
        set_flash('error', 'Impossible de marquer cet emprunt comme rendu.');
    }
    // Redirection vers la liste des emprunts
    redirect('/admin/loans');
}

function admin_loan_create($user_id, $media_id, $media_type)
{
    // Vérifie les droits د'administrateur
    require_admin();
    // Crée un nouvel emprunt
    if (create_loan($user_id, $media_id, $media_type)) {
        set_flash('success', 'Emprunt enregistré با succès.');
    } else {
        set_flash('error', 'Impossible de créer cet emprunt (limite atteinte ou média indisponible).');
    }
    // Redirection vers la liste des emprunts
    redirect('/admin/loans');
}


// ----------------- ALIASES POUR ROUTER -----------------
// Regroupés ici pour simplifier le routing
function admin_media()
{
    return admin_media_list();
}

function admin_users()
{
    return admin_users_list();
}

function admin_loans()
{
    return admin_loans_list();
}
