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

<h1>Détails utilisateur: <?php echo htmlspecialchars($user['name'] . ' ' . $user['last_name']); ?></h1>

<?php if ($user): ?>
    <p>ID: <?php echo $user['id']; ?></p>
    <p>Nom: <?php echo htmlspecialchars($user['name'] . ' ' . $user['last_name']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Rôle: <?php echo htmlspecialchars($user['role']); ?></p>
    <p>Inscrit le: <?php echo $user['created_at']; ?></p>
    
    <h2>Statistiques d'utilisation</h2>
    <ul>
        <li>Emprunts totaux: <?php echo $user['total_loans']; ?></li>
        <li>Emprunts actifs: <?php echo $user['active_loans']; ?></li>
        <li>Emprunts en retard: <?php echo count($user['overdue_loans']); ?></li>
    </ul>
    
    <h2>Emprunts actuels</h2>
    <?php if (!empty($user['loans'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Média</th>
                    <th>Date emprunt</th>
                    <th>Retour prévu</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_filter($user['loans'], fn($l) => !$l['returned_at']) as $loan): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($loan['media_title']); ?></td>
                        <td><?php echo $loan['loan_date']; ?></td>
                        <td><?php echo $loan['return_date']; ?></td>
                        <td><?php echo (strtotime($loan['return_date']) < time()) ? 'En retard' : 'OK'; ?></td>
                        <td>
                            <a href="/admin/loans/return/<?php echo $loan['id']; ?>" 
                               onclick="return confirm('Forcer le retour ?')">Retour forcé</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun emprunt en cours.</p>
    <?php endif; ?>
<?php else: ?>
    <p>Utilisateur introuvable.</p>
<?php endif; ?>