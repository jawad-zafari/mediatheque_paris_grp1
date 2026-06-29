<div class="auth-container">
    <div class="auth-card">
        
        <a href="<?php echo url('catalog/index'); ?>" class="dynamic-left-panel">
            <div class="bienvenue-text-overlay">
                <h2>Bienvenue à la Médiathèque</h2>
                <p>Découvrez notre vaste collection de livres, films et jeux vidéo.</p>
                <div class="voir-plus"><i class="fas fa-search-plus"></i> Découvrir la collection</div>
            </div>
        </a>
        
        <div class="auth-right">
            <div class="auth-header">
                <h1><?php e($title ?? 'Connexion'); ?></h1>
                <p style="color: rgba(255,255,255,0.7);">Connectez-vous à votre compte</p>
            </div>
            
            <form method="POST" class="auth-form" action="<?php echo url('auth/login'); ?>">
                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo escape(post('email', '')); ?>"
                           placeholder="votre@email.com">
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required
                           placeholder="Votre mot de passe">
                </div>
                
                <button type="submit" class="btn-full">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>
            </form>
            
            <div class="auth-footer">
                <p>Pas encore de compte ? 
                    <a href="<?php echo url('auth/register'); ?>">S'inscrire</a>
                </p>
            </div>
        </div>

    </div>
</div>