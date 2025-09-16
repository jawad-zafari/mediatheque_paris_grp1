<style>
form { max-width: 600px; margin: 20px 0; }
label { display: block; margin: 10px 0 5px; }
input, textarea, select { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px; }
textarea { height: 100px; }
button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
button:hover { background: #0056b3; }
a { color: #007bff; text-decoration: none; margin-left: 10px; }
a:hover { text-decoration: underline; }
img { margin-top: 10px; }
</style>

<?php 
$type = $media['media_type'] ?? ($_POST['type'] ?? '');
?>

<form action="<?php echo $media ? '/admin/media/save/' . $media['media_type'] . '_' . $media['id'] : '/admin/media/save'; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    
    <label>Type de média:</label>
    <select name="type" required>
        <option value="" <?php echo !$type ? 'selected' : ''; ?>>Sélectionner</option>
        <option value="livre" <?php echo $type === 'book' || $type === 'livre' ? 'selected' : ''; ?>>Livre</option>
        <option value="film" <?php echo $type === 'movie' || $type === 'film' ? 'selected' : ''; ?>>Film</option>
        <option value="jeu" <?php echo $type === 'video_game' || $type === 'jeu' ? 'selected' : ''; ?>>Jeu vidéo</option>
    </select>
    
    <label>Titre:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($media['title'] ?? ''); ?>" required>
    
    <label>Genre:</label>
    <input type="text" name="genre" value="<?php echo htmlspecialchars($media['genre'] ?? ''); ?>" required> <!-- Fix: genre -->
    
    <label>Stock (تعداد نسخه‌ها):</label>
    <input type="number" name="stock" value="<?php echo $media['stock'] ?? 1; ?>" min="0" required>
    
    <?php if ($type === 'book' || $type === 'livre'): ?>
        <label>Écrivain:</label>
        <input type="text" name="writer" value="<?php echo htmlspecialchars($media['writer'] ?? ''); ?>" required>
        <label>ISBN13:</label>
        <input type="text" name="ISBN13" value="<?php echo htmlspecialchars($media['ISBN13'] ?? ''); ?>">
        <label>Nombre de pages:</label>
        <input type="number" name="page_number" value="<?php echo $media['page_number'] ?? ''; ?>" min="1">
        <label>Synopsis:</label>
        <textarea name="synopsis"><?php echo htmlspecialchars($media['synopsis'] ?? ''); ?></textarea>
        <label>Année:</label>
        <input type="number" name="year" value="<?php echo $media['year'] ?? ''; ?>" min="1900" max="<?php echo date('Y'); ?>">
    <?php elseif ($type === 'movie' || $type === 'film'): ?>
        <label>Réalisateur:</label>
        <input type="text" name="producer" value="<?php echo htmlspecialchars($media['producer'] ?? ''); ?>" required>
        <label>Durée (minutes):</label>
        <input type="number" name="duration_m" value="<?php echo $media['duration_m'] ?? ''; ?>" min="1">
        <label>Synopsis:</label>
        <textarea name="synopsis"><?php echo htmlspecialchars($media['synopsis'] ?? ''); ?></textarea>
        <label>Classification:</label>
        <input type="text" name="classification" value="<?php echo htmlspecialchars($media['classification'] ?? ''); ?>">
        <label>Année:</label>
        <input type="number" name="year" value="<?php echo $media['year'] ?? ''; ?>" min="1900" max="<?php echo date('Y'); ?>">
    <?php elseif ($type === 'video_game' || $type === 'jeu'): ?>
        <label>Éditeur:</label>
        <input type="text" name="editor" value="<?php echo htmlspecialchars($media['editor'] ?? ''); ?>" required>
        <label>Plateforme:</label>
        <input type="text" name="platform" value="<?php echo htmlspecialchars($media['platform'] ?? ''); ?>">
        <label>Âge minimum:</label>
        <input type="number" name="min_age" value="<?php echo $media['min_age'] ?? ''; ?>" min="0">
        <label>Synopsis:</label>
        <textarea name="synopsis"><?php echo htmlspecialchars($media['synopsis'] ?? ''); ?></textarea>
        <label>Année:</label>
        <input type="number" name="year" value="<?php echo $media['year'] ?? ''; ?>" min="1900" max="<?php echo date('Y'); ?>">
    <?php endif; ?>
    
    <label>Image de couverture (optionnel):</label>
    <input type="file" name="image" accept="image/*">
    <?php if (!empty($media['image_url'])): ?>
        <img src="/uploads/covers/<?php echo htmlspecialchars($media['image_url']); ?>" style="max-width:150px;max-height:200px;">
    <?php endif; ?>
    
    <button type="submit">Enregistrer</button>
    <a href="/admin/media">Annuler</a>
</form>