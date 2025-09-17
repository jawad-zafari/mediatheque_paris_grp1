<?php


// ----------------- TABLEAU DE BORD -----------------
function get_total_media_count() {
    // Récupère le nombre total de livres
    $books = db_select_one("SELECT COUNT(*) as total FROM books")['total'] ?? 0;
    // Récupère le nombre total de films
    $movies = db_select_one("SELECT COUNT(*) as total FROM movies")['total'] ?? 0;
    // Récupère le nombre total de jeux vidéo
    $video_games = db_select_one("SELECT COUNT(*) as total FROM video_games")['total'] ?? 0;
    // Retourne la somme des médias
    return $books + $movies + $video_games;
}

function admin_dashboard() {
    // Vérifie les droits د'administrateur
    require_admin();
    // Prépare les statistiques pour le tableau de bord
    $stats = [
        'users_count' => count_users(),
        'media_count' => get_total_media_count(),
        'loans_count' => get_rentals_count(),
        'media_stats' => [
            'books' => db_select_one("SELECT COUNT(*) as total FROM books")['total'] ?? 0,
            'movies' => db_select_one("SELECT COUNT(*) as total FROM movies")['total'] ?? 0,
            'video_games' => db_select_one("SELECT COUNT(*) as total FROM video_games")['total'] ?? 0,
        ],
    ];
    // Affiche la vue du tableau de bord
    load_view_with_layout('admin/dashboard', ['stats' => $stats]);
}

// ----------------- GESTION DES MÉDIAS -----------------
function admin_media_list() {
    // Vérifie les droits د'administrateur
    require_admin();
    // Récupère tous les médias
    $medias = get_all_media();
    // Affiche la liste des médias
    load_view_with_layout('admin/media_list', ['medias' => $medias]);
}

function admin_media_edit($id = null) {
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
function admin_media_save($id = null) {
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
function admin_media_delete($id, $type) {
    require_admin();
    $type_map = ['livre' => 'book', 'film' => 'movie', 'jeu' => 'video_game'];
    $type_db = $type_map[$type] ?? $type;
    if (in_array($type_db, ['book', 'movie', 'video_game']) && delete_media($id, $type_db)) {
        set_flash('success', 'Média supprimé avec succès.');
    } else {
        set_flash('error', 'Impossible de supprimer ce média.');
    }
    redirect('/admin/media');
}

// ----------------- GESTION DES UTILISATEURS -----------------
function admin_users_list() {
    // Vérifie les droits د'administrateur
    require_admin();
    // Récupère tous les utilisateurs
    $users = get_all_users();
    // Affiche la liste des utilisateurs
    load_view_with_layout('admin/users_list', ['users' => $users]);
}

function admin_user_detail($id) {
    // Vérifie les droits د'administrateur
    require_admin();
    // Récupère les détails de ل'utilisateur
    $user = get_user_by_id($id);
    // Affiche la vue des détails de ل'utilisateur
    load_view_with_layout('admin/user_detail', ['user' => $user]);
}

// ----------------- GESTION DES EMPRUNTS -----------------
function admin_loans_list() {
    // Vérifie les droits د'administrateur
    require_admin();
    // Récupère tous les emprunts
    $loans = get_all_loans();
    // Affiche la liste des emprunts
    load_view_with_layout('admin/loans_list', ['loans' => $loans]);
}

function admin_loan_return($loan_id) {
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

function admin_loan_create($user_id, $media_id, $media_type) {
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
?>