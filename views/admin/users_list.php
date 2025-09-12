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
.flash {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}
.flash.success { background: #d4edda; color: #155724; }
.flash.error { background: #f8d7da; color: #721c24; }
a { color: #007bff; text-decoration: none; }
a:hover { text-decoration: underline; }
</style>

<h1>Liste des utilisateurs</h1>

<?php if (has_flash_messages()): ?>
    <?php foreach (get_flash_messages() as $type => $messages): ?>
        <?php foreach ($messages as $message): ?>
            <div class="flash <?php echo $type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Inscription</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['role'] ?? 'user'); ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <a href="/admin/user/<?php echo $user['id']; ?>">Voir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>