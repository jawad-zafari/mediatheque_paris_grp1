<h1>Tableau de bord</h1>
<!-- Affichage des statistiques dans une mise en page en grille -->
<section class="stats-container">
    <div class="stats-grid">
        <div class="stat-card">
            <span class="icon">👤</span>
            <h3>Utilisateurs</h3>
            <p><?= htmlspecialchars($stats['users_count'] ?? 0) ?></p>
        </div>
        <div class="stat-card">
            <span class="icon">📚</span>
            <h3>Livres</h3>
            <p><?= htmlspecialchars($stats['media_stats']['books'] ?? 0) ?></p>
        </div>
        <div class="stat-card">
            <span class="icon">🎬</span>
            <h3>Films</h3>
            <p><?= htmlspecialchars($stats['media_stats']['movies'] ?? 0) ?></p>
        </div>
        <div class="stat-card">
            <span class="icon">🎮</span>
            <h3>Jeux vidéo</h3>
            <p><?= htmlspecialchars($stats['media_stats']['video_games'] ?? 0) ?></p>
        </div>
        <div class="stat-card">
            <span class="icon">📦</span>
            <h3>Médias totaux</h3>
            <p><?= htmlspecialchars($stats['media_count'] ?? 0) ?></p>
        </div>
        <div class="stat-card">
            <span class="icon">📅</span>
            <h3>Emprunts actifs</h3>
            <p><?= htmlspecialchars($stats['loans_count'] ?? 0) ?></p>
        </div>
    </div>
</section>
<style>
    .stats-container {
        margin-top: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .stat-card {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-card .icon {
        font-size: 2em;
        margin-bottom: 10px;
        display: block;
    }
    .stat-card h3 {
        margin: 10px 0;
        font-size: 1.2em;
        color: #333;
    }
    .stat-card p {
        font-size: 1.5em;
        color: #4CAF50;
        margin: 0;
    }
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>