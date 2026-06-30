<div class="admin-container">
    <div class="admin-header"><h1>Liste des emprunts</h1></div>

    <?php if (empty($loans)): ?>
        <p>Aucun emprunt trouvé.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Média</th>
                    <th>Utilisateur</th>
                    <th>Date d'emprunt</th>
                    <th>Date d'échéance</th>
                    <th>Statut</th>
                    <th>Retour</th>
                    <th class="text-center">Modifier</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loans as $loan): ?>
                    <?php
                    $now = time();
                    $return_due_time = strtotime($loan['return_date']);
                    $returned_time = $loan['returned_at'] ? strtotime($loan['returned_at']) : null;
                    
                    $is_pending = (isset($loan['status']) && $loan['status'] === 'pending_return');
                    
                    if ($is_pending) {
                        $is_returned = false;
                    } else {
                        $is_returned = (isset($loan['status']) && $loan['status'] === 'returned') || !empty($loan['returned_at']);
                    }
                    
                    if ($is_returned && $returned_time) {
                        $days_late = floor(($returned_time - $return_due_time) / (3600 * 24));
                    } else {
                        $days_late = floor(($now - $return_due_time) / (3600 * 24));
                    }
                    
                    $is_overdue = $days_late > 0;
                    $status_text = '';
                    $status_color_class = '';
                    
                    if ($is_returned) {
                        $status_text = $is_overdue ? 'En retard (' . $days_late . ' j)' : 'À temps';
                        $status_color_class = $is_overdue ? 'text-overdue' : 'text-returned';
                    } elseif ($is_pending) {
                        $status_text = 'En attente';
                        $status_color_class = 'text-pending';
                    } else {
                        $status_text = $is_overdue ? 'En retard (' . $days_late . ' j)' : 'En cours';
                        $status_color_class = $is_overdue ? 'text-overdue' : 'text-in-progress';
                    }

                    $status_class = $is_overdue ? 'overdue' : ($is_returned ? 'returned' : 'in-progress');
                    $return_date_display = $loan['returned_at'] ? date('d/m/Y', strtotime($loan['returned_at'])) : 'Non retourné';
                    ?>
                    <tr class="<?php echo $status_class; ?>">
                        <td><?php echo htmlspecialchars($loan['media_title'] . ' (' . ($loan['media_type'] ?? '') . ')'); ?></td>
                        <td><?php echo htmlspecialchars($loan['user_name'] . ' <' . ($loan['user_email'] ?? '') . '>'); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($loan['loan_date'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($loan['return_date'])); ?></td>
                        <td><strong class="<?php echo $status_color_class; ?>"><?php echo $status_text; ?></strong></td>
                        <td><?php echo $return_date_display; ?></td>
                        
                        <td class="text-center">
                            <?php if (!$is_returned): ?>
                                <a href="<?= url('admin/loan_edit/' . $loan['id']); ?>" class="icon-btn" title="Modifier la date">✎</a>
                            <?php else: ?>
                                <span class="text-muted-action">-</span>
                            <?php endif; ?>
                        </td>

                        <td class="actions text-center">
                            <div class="action-column">
                                <?php if ($is_pending): ?>
                                    <span class="status-badge-text text-pending">À Valider</span>
                                    <form method="post" action="<?= url('admin/loan_return/' . $loan['id']); ?>" class="inline-form form-confirm-return">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                                        <button type="submit" title="Valider le retour" class="icon-btn btn-validate">✔</button>
                                    </form>
                                <?php elseif ($is_returned): ?>
                                    <?php if ($is_overdue): ?>
                                        <span class="status-badge-text text-overdue">Retourné</span>
                                    <?php else: ?>
                                        <span class="status-badge-text text-returned">Retourné</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="status-badge-text text-muted-action">Aucune action</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (isset($total_pages) && $total_pages > 1): ?>
            <?php $page = isset($page) ? $page : 1; ?>
            <div class="admin-pagination">
                <?php if ($page > 1): ?>
                    <a href="<?php echo url('admin/loans?page=' . ($page - 1)); ?>"><i class="fas fa-chevron-left"></i></a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="<?php echo url('admin/loans?page=' . $i); ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="<?php echo url('admin/loans?page=' . ($page + 1)); ?>"><i class="fas fa-chevron-right"></i></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>