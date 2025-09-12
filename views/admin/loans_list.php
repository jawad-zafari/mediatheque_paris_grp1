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
.overdue { background-color: #f8d7da; }
.in-progress { background-color: #fff3cd; }
.returned { background-color: #d4edda; }
</style>

<h1>Liste des emprunts</h1>

<?php if (has_flash_messages()): ?>
    <?php foreach (get_flash_messages() as $type => $messages): ?>
        <?php foreach ($messages as $message): ?>
            <div class="flash <?php echo $type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (empty($loans)): ?>
    <p>Aucun emprunt trouvé.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Média</th>
                <th>Utilisateur</th>
                <th>Date d'emprunt</th>
                <th>Date d'échéance</th>
                <th>Statut</th>
                <th>Retour</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loans as $loan): ?>
                <?php
                $is_overdue = !$loan['returned_at'] && strtotime($loan['return_date']) < time();
                $status_class = $is_overdue ? 'overdue' : ($loan['returned_at'] ? 'returned' : 'in-progress');
                $return_date = $loan['returned_at'] ? date('d/m/Y', strtotime($loan['returned_at'])) : 'Non retourné';
                ?>
                <tr class="<?php echo $status_class; ?>">
                    <td><?php echo htmlspecialchars($loan['media_title'] . ' (' . $loan['media_type'] . ') ' . ($loan['media_genre'] ?? '')); ?></td>
                    <td><?php echo htmlspecialchars($loan['user_name'] . ' <' . ($loan['user_email'] ?? '') . '>'); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($loan['loan_date'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($loan['return_date'])); ?></td>
                    <td><?php echo $is_overdue ? 'En retard (' . floor((time() - strtotime($loan['return_date'])) / (3600 * 24)) . ')' : ($loan['returned_at'] ? 'Retourné' : 'En cours'); ?></td>
                    <td><?php echo $return_date; ?></td>
                    <td>
                        <a href="/admin/loan/return/<?php echo $loan['id']; ?>">&#8635;</a>
                        <a href="/admin/loan/edit/<?php echo $loan['id']; ?>">&#9998;</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>