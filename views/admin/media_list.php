<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}
th {
    background: #007bff;
    color: white;
}
a { color: #007bff; text-decoration: none; }
a:hover { text-decoration: underline; }
</style>

<h1>Liste des médias</h1>

<a href="/admin/media/add">Ajouter un média</a>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Type</th>
            <th>Genre</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($medias as $media): ?>
        <tr>
            <td><?php echo htmlspecialchars($media['title']); ?></td>
            <td>
                <?php 
                    switch($media['media_type']) {
                        case 'book': echo 'Livre'; break;
                        case 'movie': echo 'Film'; break;
                        case 'video_game': echo 'Jeu vidéo'; break;
                        default: echo htmlspecialchars($media['media_type']);
                    }
                ?>
            </td>
            <td><?php echo htmlspecialchars($media['genre'] ?? ''); ?></td>
            <td><?php echo ($media['stock'] ?? 0) > 0 ? $media['stock'] : 'Indisponible'; ?></td>
            <td>
                <img src="/uploads/covers/<?php echo htmlspecialchars($media['image_url'] ?? 'default.jpg'); ?>"
                     alt="Couverture"
                     style="width:150px;height:200px;object-fit:cover;">
            </td>
            <td>
                <a href="/admin/media/edit/<?php echo $media['media_type'] . '_' . $media['id']; ?>">Modifier</a> |
                <a href="/admin/media/delete/<?php echo $media['id']; ?>/<?php echo $media['media_type']; ?>" 
                   onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>