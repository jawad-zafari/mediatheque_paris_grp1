<div class="admin-container">

    <section class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <span class="icon icon-users"><i class="fas fa-users"></i></span>
                <h3>Utilisateurs</h3>
                <p><?= htmlspecialchars($stats['users_count'] ?? 0) ?></p>
            </div>
            <div class="stat-card">
                <span class="icon icon-media"><i class="fas fa-photo-video"></i></span>
                <h3>Médias totaux</h3>
                <p><?= htmlspecialchars($stats['media_count'] ?? 0) ?></p>
            </div>
            <div class="stat-card">
                <span class="icon icon-loans"><i class="fas fa-hand-holding-heart"></i></span>
                <h3>Emprunts actifs</h3>
                <p><?= htmlspecialchars($stats['loans_count'] ?? 0) ?></p>
            </div>
            <div class="stat-card">
                <span class="icon icon-books"><i class="fas fa-book"></i></span>
                <h3>Livres</h3>
                <p><?= htmlspecialchars($stats['media_stats']['books'] ?? 0) ?></p>
            </div>
            <div class="stat-card">
                <span class="icon icon-movies"><i class="fas fa-film"></i></span>
                <h3>Films</h3>
                <p><?= htmlspecialchars($stats['media_stats']['movies'] ?? 0) ?></p>
            </div>
            <div class="stat-card">
                <span class="icon icon-games"><i class="fas fa-gamepad"></i></span>
                <h3>Jeux vidéo</h3>
                <p><?= htmlspecialchars($stats['media_stats']['video_games'] ?? 0) ?></p>
            </div>
        </div>
    </section>

    <div class="dashboard-distribution">
        <h2>Répartition du Catalogue</h2>
        
        <div class="dist-card">
            <?php
            $books = intval($stats['media_stats']['books'] ?? 0);
            $movies = intval($stats['media_stats']['movies'] ?? 0);
            $games = intval($stats['media_stats']['video_games'] ?? 0);
            $total_media = max(1, $books + $movies + $games);
            
            $pct_books = intval(round(($books / $total_media) * 100));
            $pct_movies = intval(round(($movies / $total_media) * 100));
            $pct_games = intval(round(($games / $total_media) * 100));
            ?>

            <div class="dist-item">
                <div class="dist-header">
                    <span class="dist-label"><i class="fas fa-book text-book"></i> Livres</span>
                    <span class="dist-value text-book"><?= $books ?> <span>(<?= $pct_books ?>%)</span></span>
                </div>
                <div class="dist-bar-track">
                    <div class="dist-bar book" data-width="<?= $pct_books ?>%"></div>
                </div>
            </div>

            
</div>