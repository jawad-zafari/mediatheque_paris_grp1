<div class="admin-container">
    <div class="form-card">
    <?php 
    $media = $media ?? [];
    $type = $resolved_type ?? ($media['media_type'] ?? ($_POST['type'] ?? ($_GET['type'] ?? '')));
    $is_edit = !empty($media);
    ?>

    <form action="<?php echo $media ? url('admin/media_save/' . $media['media_type'] . '_' . $media['id']) : url('admin/media_save'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
        
        <label>Type de média :</label>
        <select name="type" id="media_type_select" required class="<?php echo $is_edit ? 'readonly-select' : ''; ?>">
            <option value="">Sélectionner</option>
            <option value="livre" <?php echo ($type === 'book' || $type === 'livre') ? 'selected' : ''; ?>>Livre</option>
            <option value="film" <?php echo ($type === 'movie' || $type === 'film') ? 'selected' : ''; ?>>Film</option>
            <option value="jeu" <?php echo ($type === 'video_game' || $type === 'jeu') ? 'selected' : ''; ?>>Jeu vidéo</option>
        </select>
        <?php if ($is_edit): ?>
            <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
        <?php endif; ?>
        
        <label>Titre :</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($media['title'] ?? ''); ?>" required>
        
        <label>Genre :</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($media['genre'] ?? ''); ?>" required>
        
        <label>Stock :</label>
        <input type="number" name="stock" value="<?php echo $media['stock'] ?? 1; ?>" min="1" required>

        <label>Année :</label>
        <input type="number" name="year" value="<?php echo $media['year'] ?? ''; ?>" min="1900" max="<?php echo date('Y'); ?>" required>
        
        <label>Synopsis / Description :</label>
        <textarea name="synopsis" class="form-textarea-large" required><?php echo htmlspecialchars($media['synopsis'] ?? ($media['description'] ?? '')); ?></textarea>

        <div id="fields_livre" class="form-dynamic-group">
            <label>Écrivain :</label>
            <input type="text" name="writer" value="<?php echo htmlspecialchars($media['writer'] ?? ''); ?>">
            
            <label>ISBN13 :</label>
            <input type="text" name="ISBN13" value="<?php echo htmlspecialchars($media['ISBN13'] ?? ''); ?>">
            
            <label>Nombre de pages :</label>
            <input type="number" name="page_number" value="<?php echo $media['page_number'] ?? ''; ?>" min="1">
        </div>

        <div id="fields_film" class="form-dynamic-group">
            <label>Réalisateur :</label>
            <input type="text" name="producer" value="<?php echo htmlspecialchars($media['producer'] ?? ''); ?>">
            
            <label>Durée (minutes) :</label>
            <input type="number" name="duration_m" value="<?php echo $media['duration_m'] ?? ($media['duration'] ?? ''); ?>" min="1">
            
            <label>Classification :</label>
            <select name="classification">
                <option value="">Sélectionner</option>
                <?php
                $current_class = $media['classification'] ?? '';
                $allowed_class = ['Tous publics', '-12', '-16', '-18'];
                foreach ($allowed_class as $c) {
                    echo '<option value="'.$c.'" '.($current_class === $c ? 'selected' : '').'>'.$c.'</option>';
                }
                if ($current_class && !in_array($current_class, $allowed_class)) {
                    echo '<option value="'.htmlspecialchars($current_class).'" selected>'.htmlspecialchars($current_class).' (actuel)</option>';
                }
                ?>
            </select>
        </div>

        <div id="fields_jeu" class="form-dynamic-group">
            <label>Éditeur :</label>
            <input type="text" name="editor" value="<?php echo htmlspecialchars($media['editor'] ?? ''); ?>">
            
            <label>Plateforme :</label>
            <select name="platform">
                <option value="">Sélectionner</option>
                <?php
                $current_platform = $media['platform'] ?? ($media['plateform'] ?? '');
                $allowed_platforms = ['PC', 'PlayStation', 'Xbox', 'Nintendo', 'Mobile'];
                foreach ($allowed_platforms as $p) {
                    echo '<option value="'.$p.'" '.($current_platform === $p ? 'selected' : '').'>'.$p.'</option>';
                }
                if ($current_platform && !in_array($current_platform, $allowed_platforms)) {
                    echo '<option value="'.htmlspecialchars($current_platform).'" selected>'.htmlspecialchars($current_platform).' (actuel)</option>';
                }
                ?>
            </select>
            
            <label>Âge minimum :</label>
            <select name="min_age">
                <option value="">Sélectionner</option>
                <?php
                $current_age = isset($media['min_age']) ? intval($media['min_age']) : null;
                $allowed_ages = [3,7,12,16,18];
                foreach ($allowed_ages as $a) {
                    echo '<option value="'.$a.'" '.($current_age === $a ? 'selected' : '').'>'.$a.'</option>';
                }
                if ($current_age !== null && !in_array($current_age, $allowed_ages)) {
                    echo '<option value="'.$current_age.'" selected>'.$current_age.' (actuel)</option>';
                }
                ?>
            </select>
        </div>

        <label>Image de couverture (optionnel) :</label>
        <input type="file" name="image" accept="image/*">
        <?php if (!empty($media['image_url'])): ?>
            <img src="<?= url('uploads/covers/' . $media['image_url']); ?>" class="cover-thumb-large">
        <?php endif; ?>
        
        <div class="form-submit-row">
            <button type="submit" class="btn-save">Enregistrer</button>
            <a href="<?= url('admin/media'); ?>" class="btn-cancel">Annuler</a>
        </div>
    </form>
    </div>
</div>