<?php
// Affichage de la page des emprunts de l'utilisateur avec deux tableaux : emprunts actifs et historiques
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
        .rental-image {
            width: 40px;
            height: auto;
            margin-right: 10px;
            vertical-align: middle;
        }
        .rentals-table {
            width: 100%;
            /* border-collapse: collapse; */
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .rentals-table th,
        .rentals-table td {
            border-radius: 5px;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .rentals-table th {
            background-color: #000000ff;
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
        .section-title {
            margin-top: 30px;
            font-size: 1.5em;
            color: #333;
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

        <!-- Affichage des emprunts actifs -->
        <section class="rentals-list">
            <h2 class="section-title">Emprunts en cours</h2>
            <?php
            // Trier les emprunts actifs par date d'emprunt (nouveau en haut)
            usort($active_rentals, function($a, $b) {
                return strtotime($b['rent_date']) - strtotime($a['rent_date']);
            });
            ?>
            <?php if (empty($active_rentals)): ?>
                <p>Vous n'avez aucun emprunt en cours.</p>
            <?php else: ?>
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Date d'Emprunt</th>
                            <th>Date de Retour</th>
                            <th>Retard (jours)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($active_rentals as $rental): ?>
                            <tr>
                                <td>
                                    <!-- Affichage de l'image à côté du titre avec une taille de 40px -->
                                    <img src="<?php echo htmlspecialchars($rental['image_url'] ?? 'https://via.placeholder.com/40'); ?>" alt="<?php echo htmlspecialchars($rental[''] ?? ''); ?>" class="rental-image">
                                    <?php echo htmlspecialchars($rental['title'] ?? ''); ?>
                                </td>
                                <td><?php echo htmlspecialchars($rental['type'] == 'book' ? 'Livre' : ($rental['type'] == 'movie' ? 'Film' : ($rental['type'] == 'video_game' ? 'Jeu Vidéo' : ''))); ?></td>
                                <td><?php echo htmlspecialchars($rental['rent_date'] ? format_date($rental['rent_date']) : ''); // Utilisation de format_date pour fuseau horaire utilisateur ?></td>
                                <td><?php echo htmlspecialchars($rental['return_date'] ? format_date($rental['return_date']) : ''); // Utilisation de format_date pour fuseau horaire utilisateur ?></td>
                                <td>
                                    <?php
                                    // Calcul du retard با استفاده از تاریخ واقعی بازگشت
                                    $days_late = calculate_days_late($rental['return_date'], $rental['returned_at']);
                                    echo htmlspecialchars($days_late) . ' jours';
                                    ?>
                                </td>
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

        <!-- Affichage des emprunts retournés (historique) -->
        <section class="rentals-list">
            <h2 class="section-title">Historique des emprunts</h2>
            <?php
            // Trier les emprunts بازگشت داده شده بر اساس تاریخ بازگشت (نوین در بالا)
            usort($returned_rentals, function($a, $b) {
                return strtotime($b['returned_at']) - strtotime($a['returned_at']);
            });
            ?>
            <?php if (empty($returned_rentals)): ?>
                <p>Vous n'avez aucun emprunt retourné.</p>
            <?php else: ?>
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Date d'Emprunt</th>
                            <th>Date de Retour</th>
                            <th>Retard (jours)</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($returned_rentals as $rental): ?>
                            <tr>
                                <td>
                                    <!-- Affichage de l'image à côté du titre avec une taille de 40px -->
                                    <img src="<?php echo htmlspecialchars($rental['image_url'] ?? ''); ?>" alt="<?php echo htmlspecialchars($rental[''] ?? ''); ?>" class="rental-image">
                                    <?php echo htmlspecialchars($rental['title'] ?? ''); ?>
                                </td>
                                <td><?php echo htmlspecialchars($rental['type'] == 'book' ? 'Livre' : ($rental['type'] == 'movie' ? 'Film' : ($rental['type'] == 'video_game' ? 'Jeu Vidéo' : ''))); ?></td>
                                <td><?php echo htmlspecialchars($rental['rent_date'] ? format_date($rental['rent_date']) : ''); // Utilisation de format_date pour fuseau horaire utilisateur ?></td>
                                <td><?php echo htmlspecialchars($rental['returned_at'] ? format_date($rental['returned_at']) : ''); // Utilisation de format_date pour fuseau horaire utilisateur ?></td>
                                <td>
                                    <?php
                                    // Calcul du retard با استفاده از تاریخ واقعی بازگشت
                                    $days_late = calculate_days_late($rental['return_date'], $rental['returned_at']);
                                    echo htmlspecialchars($days_late) . ' jours';
                                    ?>
                                </td>
                                <td>
                                    <span class="returned">Retourné</span>
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