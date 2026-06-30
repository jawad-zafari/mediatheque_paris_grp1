<div class="admin-container">
    <div class="form-card">
    <?php 
    $media = $media ?? [];
    $type = $resolved_type ?? ($media['media_type'] ?? ($_POST['type'] ?? ($_GET['type'] ?? '')));
    $is_edit = !empty($media);
    ?>

    