<?php 
$hide_banner = true; 
?>
<div class="profile-container">
    
    <aside class="profile-sidebar">
        <div class="user-avatar">
            <i class="fas fa-user-circle fa-4x" style="color: #38bdf8;"></i>
            <h3 style="margin-top: 10px; color: #ffffff;">Mon Compte</h3>
        </div>
        
        <ul class="profile-menu">
            <li><a href="#" class="tab-link active" data-tab="tab-voir-profil"><i class="fas fa-id-card"></i> Mon Profil</a></li>
            <li><a href="#" class="tab-link" data-tab="tab-mes-emprunts"><i class="fas fa-book-reader"></i> Mes Emprunts</a></li>
            <li><a href="<?php echo url('auth/logout'); ?>" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
        </ul>
    </aside>

    <main class="profile-content">
        
        <div id="tab-voir-profil" class="profile-tab-content active-tab">
            <h2 class="profile-section-title">Informations Personnelles</h2>
            <p style="margin-bottom: 25px; color: #ffffffb3;">Voici les détails actuels de votre compte utilisateur.</p>
            
            <div class="profile-details-list">
                <div class="profile-info-box">
                    <span class="info-label">Prénom</span>
                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'Non renseigné'); ?></span>
                </div>
                <div class="profile-info-box">
                    <span class="info-label">Nom</span>
                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['user']['last_name'] ?? 'Non renseigné'); ?></span>
                </div>
                <div class="profile-info-box">
                    <span class="info-label">Adresse Email</span>
                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['user']['email'] ?? 'Non renseigné'); ?></span>
                </div>
            </div>
            
            <button id="btn-show-edit" class="btn-profile-edit">
                <i class="fas fa-user-edit"></i> Modifier mes informations
            </button>

            <div id="section-modification-form" style="display: none; margin-top: 35px; padding-top: 25px; border-top: 1px solid rgba(255,255,255,0.15);">
                <h3 class="profile-subsection-title">Formulaire de mise à jour</h3>
                <form action="<?php echo url('home/update_profile'); ?>" method="post" class="profile-modern-form">
                    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                    
                    <div class="form-grid-two">
                        <div class="form-group-profile">
                            <label>Prénom <span style="color:var(--admin-danger);">*</span></label>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['name'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group-profile">
                            <label>Nom <span style="color:var(--admin-danger);">*</span></label>
                            <input type="text" name="last_name" value="<?php echo htmlspecialchars($_SESSION['user']['last_name'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group-profile" style="margin-bottom: 20px;">
                        <label>Adresse Email <span style="color:var(--admin-danger);">*</span></label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?>" required>
                    </div>

                    <h4 style="color: #38bdf8; margin-bottom: 15px; border-bottom: 1px solid rgba(56, 189, 248, 0.3); padding-bottom: 5px;">Changer de mot de passe <span style="font-weight: normal; opacity: 0.6; font-size: 0.8rem;">(Optionnel)</span></h4>

                    <div class="form-group-profile password-wrapper">
                        <label>Mot de passe actuel</label>
                        <div class="input-with-icon">
                            <input type="password" name="current_password" id="current_password" placeholder="Requis si vous changez le mot de passe">
                            <i class="fas fa-eye toggle-password" data-target="current_password"></i>
                        </div>
                    </div>

                    <div class="form-grid-two">
                        <div class="form-group-profile password-wrapper">
                            <label>Nouveau mot de passe</label>
                            <div class="input-with-icon">
                                <input type="password" name="new_password" id="new_password" placeholder="Minimum 8 caractères">
                                <i class="fas fa-eye toggle-password" data-target="new_password"></i>
                            </div>
                        </div>
                        <div class="form-group-profile password-wrapper">
                            <label>Confirmer le mot de passe</label>
                            <div class="input-with-icon">
                                <input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="Répéter le nouveau mot de passe">
                                <i class="fas fa-eye toggle-password" data-target="confirm_new_password"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions-profile" style="margin-top: 25px;">
                        <button type="button" id="btn-hide-edit" class="btn-profile-cancel">Annuler</button>
                        <button type="submit" class="btn-profile-save">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="tab-mes-emprunts" class="profile-tab-content" style="display: none;">
            <h2 class="profile-section-title">Mes Emprunts</h2>
            <p style="margin-bottom: 25px; color: #ffffffb3;">Consultez vos médias en cours d'utilisation.</p>
            
            <div class="rentals-section">
                <?php if (empty($active_rentals)): ?>
                    <p class="empty-state"><i class="fas fa-box-open"></i> Vous n'avez aucun emprunt en cours.</p>
                <?php else: ?>
                    <div class="rentals-list-container">
                        <?php foreach ($active_rentals as $rental): ?>
                            <div class="rental-card">
                                <?php if (!empty($rental['image_url'])): ?>
                                    <img src="<?php echo url('uploads/covers/' . $rental['image_url']); ?>" class="rental-card-img" alt="Cover">
                                <?php else: ?>
                                    <div class="rental-card-img" style="background: #012447; display:flex; align-items:center; justify-content:center; color:white;"><i class="fas fa-image"></i></div>
                                <?php endif; ?>
                                
                                <div class="rental-card-info">
                                    <h3><?php echo htmlspecialchars($rental['title']); ?></h3>
                                    <div class="rental-meta">
                                        <span><i class="fas fa-calendar-alt"></i> Emprunté le : <?php echo date('d/m/Y', strtotime($rental['rent_date'])); ?></span>
                                    </div>
                                </div>
                                
                                <div class="rental-card-actions">
                                    <?php if (isset($rental['status']) && $rental['status'] === 'pending_return'): ?>
                                        <span class="badge-status badge-active" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border-color: rgba(245, 158, 11, 0.3);">En attente Admin</span>
                                    <?php else: ?>
                                        <span class="badge-status badge-active">En cours</span>
                                        <a href="<?php echo url('borrow/return/' . $rental['id'] . '?from=profile'); ?>" class="btn-return-modern">
                                            <i class="fas fa-undo"></i> Retourner
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </main>
</div>