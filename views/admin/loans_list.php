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
               