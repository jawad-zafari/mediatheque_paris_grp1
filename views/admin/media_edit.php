<div class="admin-container">
    <div class="form-card">
<?php 
// Determine which type to show fields for:
// Priority: resolved_type from controller (derived from id or GET) -> media media_type -> POST -> GET -> ''
$type = $resolved_type ?? ($media['media_type'] ?? ($_POST['type'] ?? ($_GET['type'] ?? '')));
?>

<form action="<?php echo $media ? url('admin/media_save/' . $media['media_type'] . '_' . $media['id']) : url('admin/media_save'); ?>" method="post" enctype="multipart/form-data">
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
    <input type="number" name="stock" value="<?php echo $media['stock'] ?? 1; ?>" min="1" required>
    
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
        <?php
            $current_class = $media['classification'] ?? '';
            $allowed_class = ['Tous publics', '-12', '-16', '-18'];
        ?>
        <select name="classification" required>
            <option value="" <?php echo empty($current_class) ? 'selected' : ''; ?>>Sélectionner</option>
            <?php foreach ($allowed_class as $c): ?>
                <option value="<?php echo $c; ?>" <?php echo ($current_class === $c) ? 'selected' : ''; ?>><?php echo $c; ?></option>
            <?php endforeach; ?>
            <?php if ($current_class !== '' && !in_array($current_class, $allowed_class)): ?>
                <option value="<?php echo htmlspecialchars($current_class); ?>" selected><?php echo htmlspecialchars($current_class); ?> (actuel)</option>
            <?php endif; ?>
        </select>
        <label>Année:</label>
        <input type="number" name="year" value="<?php echo $media['year'] ?? ''; ?>" min="1900" max="<?php echo date('Y'); ?>">
    <?php elseif ($type === 'video_game' || $type === 'jeu'): ?>
        <label>Éditeur:</label>
        <input type="text" name="editor" value="<?php echo htmlspecialchars($media['editor'] ?? ''); ?>" required>
        <label>Plateforme:</label>
        <?php
            $current_platform = $media['platform'] ?? '';
            $allowed_platforms = ['PC', 'PlayStation', 'Xbox', 'Nintendo', 'Mobile'];
        ?>
        <select name="platform" required>
            <option value="" <?php echo empty($current_platform) ? 'selected' : ''; ?>>Sélectionner</option>
            <?php foreach ($allowed_platforms as $p): ?>
                <option value="<?php echo $p; ?>" <?php echo ($current_platform === $p) ? 'selected' : ''; ?>><?php echo $p; ?></option>
            <?php endforeach; ?>
            <?php if ($current_platform !== '' && !in_array($current_platform, $allowed_platforms)): ?>
                <option value="<?php echo htmlspecialchars($current_platform); ?>" selected><?php echo htmlspecialchars($current_platform); ?> (actuel)</option>
            <?php endif; ?>
        </select>
        <label>Âge minimum:</label>
        <?php
            $current_age = isset($media['min_age']) ? intval($media['min_age']) : null;
            $allowed_ages = [3,7,12,16,18];
        ?>
        <select name="min_age" required>
            <option value="" <?php echo $current_age === null ? 'selected' : ''; ?>>Sélectionner</option>
            <?php foreach ($allowed_ages as $a): ?>
                <option value="<?php echo $a; ?>" <?php echo ($current_age === $a) ? 'selected' : ''; ?>><?php echo $a; ?></option>
            <?php endforeach; ?>
            <?php if ($current_age !== null && !in_array($current_age, $allowed_ages)): ?>
                <option value="<?php echo $current_age; ?>" selected><?php echo $current_age; ?> (actuel)</option>
            <?php endif; ?>
        </select>
        <label>Synopsis:</label>
        <textarea name="synopsis"><?php echo htmlspecialchars($media['synopsis'] ?? ''); ?></textarea>
        <label>Année:</label>
        <input type="number" name="year" value="<?php echo $media['year'] ?? ''; ?>" min="1900" max="<?php echo date('Y'); ?>">
    <?php endif; ?>
    
    <label>Image de couverture (optionnel):</label>
    <input type="file" name="image" accept="image/*">
    <?php if (!empty($media['image_url'])): ?>
        <img src="<?= url('uploads/covers/' . $media['image_url']); ?>" class="cover-thumb">
    <?php endif; ?>
    
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="<?= url('admin/media'); ?>" class="btn-link">Annuler</a>
    </div>
</div>