<?php
/* Vue pour l'affichage de la page des emprunts de l'utilisateur */
$hide_banner = true; 
?>

<section class="borrow-page-container">
    
    <div class="borrow-header">
        <h1>Mes Emprunts</h1>
        <p>Gérez vos médias en cours et consultez votre historique</p>
    </div>

    <section class="rentals-section">
        <h2 class="rentals-section-title">Emprunts en cours</h2>
        
        <div class="rentals-list-container">
            <?php if (empty($active_rentals)): ?>
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>Vous n'avez aucun emprunt en cours.</p>
                </div>
            <?php else: ?>
                <?php foreach ($active_rentals as $rental): ?>
                    <?php 
                        /* Icone selon le type de media */
                        $icon = 'fa-photo-video';
                        $type_name = 'Média';
                        if($rental['type'] == 'book') { $icon = 'fa-book'; $type_name = 'Livre'; }
                        elseif($rental['type'] == 'movie' || $rental['type'] == 'film') { $icon = 'fa-film'; $type_name = 'Film'; }
                        elseif($rental['type'] == 'video_game' || $rental['type'] == 'game') { $icon = 'fa-gamepad'; $type_name = 'Jeu Vidéo'; }
                        
                        /* Calcul du retard */
                        $days_late = calculate_days_late($rental['return_date'], $rental['returned_at']);
                    ?>
                    
                    <div class="rental-card">
                        <img src="<?php echo htmlspecialchars($rental['image_url'] ?? 'https://via.placeholder.com/100'); ?>" alt="" class="rental-card-img">
                        
                        <div class="rental-card-info">
                            <h3><?php echo htmlspecialchars($rental['title'] ?? 'Sans titre'); ?></h3>
                            <div class="rental-meta">
                                <span><i class="fas <?php echo $icon; ?>"></i> <?php echo $type_name; ?></span>
                                <span><i class="fas fa-calendar-alt"></i> Emprunté le : <?php echo htmlspecialchars($rental['rent_date'] ? format_date($rental['rent_date']) : ''); ?></span>
                                <span><i class="fas fa-calendar-check"></i> Retour prévu : <?php echo htmlspecialchars($rental['return_date'] ? format_date($rental['return_date']) : ''); ?></span>
                            </div>
                        </div>
                        
                        <div class="rental-card-actions">
                            <?php if (isset($rental['status']) && $rental['status'] === 'pending_return'): ?>
                                <span class="badge-status" >
                                    <i class="fas fa-hourglass-half"></i> En attente
                                </span>
                            <?php else: ?>
                                <?php if ($days_late > 0): ?>
                                    <span class="badge-status badge-late">En retard (<?php echo htmlspecialchars($days_late); ?> j)</span>
                                <?php else: ?>
                                    <span class="badge-status badge-active">Actif</span>
                                <?php endif; ?>
                                
                                <a href="<?php echo url('borrow/return/' . $rental['id']); ?>" class="btn-return-modern">
                                    <i class="fas fa-undo-alt"></i> Retourner
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <section class="rentals-section">
        <h2 class="rentals-section-title">Historique des emprunts</h2>
        
        <div class="rentals-list-container">
            <?php if (empty($returned_rentals)): ?>
                <div class="empty-state">
                    <i class="fas fa-history"></i>
                    <p>Votre historique est vide.</p>
                </div>
            <?php else: ?>
                <?php foreach ($returned_rentals as $rental): ?>
                    <?php 
                        /* Icone selon le type de media */
                        $icon = 'fa-photo-video';
                        $type_name = 'Média';
                        if($rental['type'] == 'book') { $icon = 'fa-book'; $type_name = 'Livre'; }
                        elseif($rental['type'] == 'movie' || $rental['type'] == 'film') { $icon = 'fa-film'; $type_name = 'Film'; }
                        elseif($rental['type'] == 'video_game' || $rental['type'] == 'game') { $icon = 'fa-gamepad'; $type_name = 'Jeu Vidéo'; }
                    ?>
                    
                    <div class="rental-card">
                        <img src="<?php echo htmlspecialchars($rental['image_url'] ?? 'https://via.placeholder.com/100'); ?>" alt="" class="rental-card-img" style="opacity: 0.7; filter: grayscale(50%);">
                        
                        <div class="rental-card-info" style="opacity: 0.8;">
                            <h3><?php echo htmlspecialchars($rental['title'] ?? 'Sans titre'); ?></h3>
                            <div class="rental-meta">
                                <span><i class="fas <?php echo $icon; ?>"></i> <?php echo $type_name; ?></span>
                                <span><i class="fas fa-calendar-alt"></i> Emprunté le : <?php echo htmlspecialchars($rental['rent_date'] ? format_date($rental['rent_date']) : ''); ?></span>
                                <span><i class="fas fa-check-circle" style="color: #10b981;"></i> Rendu le : <?php echo htmlspecialchars($rental['returned_at'] ? format_date($rental['returned_at']) : ''); ?></span>
                            </div>
                        </div>
                        
                        <div class="rental-card-actions">
                            <?php 
                            $return_due_hist = strtotime($rental['return_date']);
                            $returned_at_hist = strtotime($rental['returned_at']);
                            $days_late_hist = floor(($returned_at_hist - $return_due_hist) / (3600 * 24));
                            ?>
                            <?php if ($days_late_hist > 0): ?>
                                <span class="badge-status" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">
                                    <i class="fas fa-exclamation-circle"></i> Retourné en retard
                                </span>
                            <?php else: ?>
                                <span class="badge-status badge-returned"><i class="fas fa-check"></i> Retourné</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

</section>