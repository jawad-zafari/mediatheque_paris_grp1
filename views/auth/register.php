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
                <h1><?php e($title ?? 'Inscription'); ?></h1>
                <p style="color: rgba(255,255,255,0.7);">Créez votre compte</p>
            </div>
            
            <form method="POST" class="auth-form" action="<?php echo url('auth/register'); ?>">
                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                
                <div class="form-group">
                    <label for="name">Prénom</label>
                    <input type="text" id="name" name="name" required 
                           value="<?php echo escape(post('name', '')); ?>"
                           placeholder="Votre prénom"
                           pattern="[A-Za-zÀ-ÿ\s\-]{2,50}"
                           title="2 à 50 lettres, espaces et tirets uniquement">
                </div>

                