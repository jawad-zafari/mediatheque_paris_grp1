<div class="profile-container">
    
    <aside class="profile-sidebar">
        <div class="user-avatar">
            <i class="fas fa-user-circle fa-4x"></i>
            <h3>Mon Compte</h3>
        </div>
        
        <ul class="profile-menu">
            <li><a href="<?php echo url('home/profile'); ?>">Mon Profil</a></li>
            <li><a href="<?php echo url('rental/my_rentals'); ?>">Mes Emprunts</a></li>
            <li><a href="<?php echo url('auth/logout'); ?>" class="btn-logout">Déconnexion</a></li>
        </ul>
    </aside>

    <main class="profile-content">
        <h2>Bienvenue sur votre profil</h2>
        <p>Ici, vous pouvez gérer vos informations et voir vos activités.</p>
        
        <div class="profile-details">
            <p><strong>Nom d'utilisateur:</strong> <?php echo $_SESSION['user']['username'] ?? 'Utilisateur'; ?></p>
            <p><strong>Rôle:</strong> <?php echo $_SESSION['user']['role'] ?? 'Membre'; ?></p>
        </div>
    </main>

</div>