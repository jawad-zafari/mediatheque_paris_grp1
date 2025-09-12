<?php
// Affichage de la page des emprunts de l'utilisateur
// Utilisation de la fonction url() pour les liens
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Mes Emprunts'); ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <style>
        .rentals-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .rentals-table th,
        .rentals-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .rentals-table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        .rentals-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .rentals-table tr:hover {
            background-color: #f1f1f1;
        }
        .btn-return {
            background-color: #ff4444;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-return:hover {
            background-color: #cc0000;
        }
        .returned {
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
    <section class="container">
        <section class="banner">
            <section class="hero-banner">
                <h1>Mes Emprunts</h1>
                <p class="hero-subtitle">Liste de vos médias empruntés</p>
            </section>
        </section>

        <!-- Affichage des messages flash (succès ou erreur) -->
        <?php if (has_flash_messages('success')): ?>
            <?php foreach (get_flash_messages('success') as $message): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (has_flash_messages('error')): ?>
            <?php foreach (get_flash_messages('error') as $message): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Affichage de la liste des emprunts -->
        <section class="rentals-list">
            <?php if (empty($rentals)): ?>
                <p>Vous n'avez aucun emprunt.</p>
            <?php else: ?>
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Date d'Emprunt</th>
                            <th>Date de Retour</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rentals as $rental): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($rental['title'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($rental['type'] == 'book' ? 'Livre' : ($rental['type'] == 'movie' ? 'Film' : ($rental['type'] == 'video_game' ? 'Jeu Vidéo' : ''))); ?></td>
                                <td><?php echo htmlspecialchars($rental['rent_date'] ? date('d/m/Y', strtotime($rental['rent_date'])) : ''); ?></td>
                                <td><?php echo htmlspecialchars($rental['return_date'] ? date('d/m/Y', strtotime($rental['return_date'])) : ''); ?></td>
                                <td>
                                    <?php if ($rental['returned_at'] === null): ?>
                                        <a href="<?php echo url('rental/return/' . $rental['id']); ?>" class="btn-return">Retourner</a>
                                    <?php else: ?>
                                        <span class="returned">Retourné</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </section>

    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
</body>
</html>