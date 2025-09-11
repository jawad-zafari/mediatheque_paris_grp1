<?php
declare(strict_types=1);

// On ne démarre la session que si elle n’est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DEBUG', false);

/* 
   Données utilisateur simulées
   */
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        "nom"    => "Nadir",
        "prenom" => "Souifi",
        "email"  => "ndr@icloud.com",
        "age"    => 21,
        "bio"    => "Développeur web passionné par le design.",
        "avatar" => "https://www.shutterstock.com/image-illustration/blank-profile-photo-flat-face-260nw-2271909553.jpg"
    ];
}
$user = $_SESSION['user'];

/* =
   CSRF Token
   = */
if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* =
   Détection succès PRG
   = */
$success = isset($_GET['saved']); // après redirection avec ?saved=1

/* Helper pour récupérer une valeur POST textuelle */
function post_str(string $key): string {
    return (isset($_POST[$key]) && is_string($_POST[$key])) ? trim($_POST[$key]) : '';
}

/* =
   Traitement formulaire
    */
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted_csrf = post_str('csrf_token');

    if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $submitted_csrf)) {
        $errors['csrf'] = "Jeton CSRF invalide ou manquant — veuillez réessayer.";
    }

    if (empty($errors)) {
        $prenom = post_str('prenom');
        $nom    = post_str('nom');
        $email  = filter_var(post_str('email'), FILTER_VALIDATE_EMAIL);
        $age    = filter_var(post_str('age'), FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 120]]);
        $bio    = post_str('bio');
        $avatar = filter_var(post_str('avatar'), FILTER_VALIDATE_URL);

        if ($prenom === '' || $nom === '') $errors['name'] = "Nom et prénom requis.";
        if ($email === false) $errors['email'] = "Email invalide.";
        if ($age === false) $errors['age'] = "Âge invalide (0–120).";
        if ($avatar === false || parse_url($avatar, PHP_URL_SCHEME) !== 'https') {
            $errors['avatar'] = "URL de l'avatar invalide (attendu https://...).";
        }

        if (empty($errors)) {
            $_SESSION['user'] = compact('prenom','nom','email','age','bio','avatar');
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // nouveau token
            header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?saved=1'); // PRG avec succès
            exit;
        }

        // Conserver les valeurs saisies si erreurs
        $user = array_merge($user, [
            'prenom' => $prenom,
            'nom'    => $nom,
            'email'  => $email ?: $user['email'],
            'age'    => $age !== false ? $age : $user['age'],
            'bio'    => $bio,
            'avatar' => $avatar ?: $user['avatar'],
        ]);
    }
}


$edit = isset($_GET['edit']) && $_GET['edit'] === '1';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil utilisateur</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>

<!-- un Message de succès -->
<?php if (!empty($success)): ?>
    <div class="success-message">
        Profil mis à jour avec succès !
    </div>
<?php endif; ?>

<!-- Barre latérale bleu ciel -->
<div class="left-bar"></div>

<!-- Conteneur carte profil -->
<div class="profil-card-container">
    <div class="profil-card">

        <?php if (DEBUG): ?>
            <div style="background:#ffecec;padding:10px;border:1px solid #f5c2c2;margin-bottom:12px;">
                <strong>DEBUG:</strong><br>
                Session id: <?= e(session_id()) ?><br>
                CSRF session token: <?= e($_SESSION['csrf_token'] ?? '') ?><br>
            </div>
        <?php endif; ?>

        <?php if (!$edit): ?>
            <div class="profil-header">
                <img src="<?= e($user['avatar']) ?>" alt="Avatar de <?= e($user['prenom']) ?>" class="avatar">
                <h2><?= e($user['prenom'].' '.$user['nom']) ?></h2>
                <p><a href="?edit=1" class="btn-edit">Modifier le profil</a></p>
            </div>
            <div class="profil-info">
                <p><strong>Email :</strong> <?= e($user['email']) ?></p>
                <p><strong>Âge :</strong> <?= (int)$user['age'] ?> ans</p>
                <p><strong>Bio :</strong><br>
                    <?php echo nl2br((string)($user['bio'] ?? '')); ?>
                </p>
            </div>
        <?php else: ?>
            <h2 style="text-align:center;margin-bottom:20px;">Modifier le profil</h2>

            <?php if (!empty($errors)): ?>
                <ul class="errors">
                    <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form method="post" action="?edit=1" novalidate class="profil-edit">
                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

                <label>Prénom
                    <input type="text" name="prenom" value="<?= e($user['prenom']) ?>" required>
                </label>
                <label>Nom
                    <input type="text" name="nom" value="<?= e($user['nom']) ?>" required>
                </label>
                <label>Email
                    <input type="email" name="email" value="<?= e($user['email']) ?>" required>
                </label>
                <label>Âge
                    <input type="number" name="age" value="<?= (int)$user['age'] ?>" required min="0" max="120">
                </label>
                <label>Bio
                    <textarea name="bio" required><?= e($user['bio'] ?? '') ?></textarea>
                </label>
                <label>Avatar URL
                    <input type="url" name="avatar" value="<?= e($user['avatar']) ?>" required>
                </label>

                <button type="submit">Enregistrer</button>
            </form>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
