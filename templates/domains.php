<?php $title="Mes redirections"; ?> 
<?php ob_start(); ?>
    <main>
    <div class="container">
        <div class="left-column">
            <h2>Noms de Domaines</h2>
            <ul>
                <li><?= htmlspecialchars($_SERVER['HTTP_HOST']); ?></li>
            </ul>
        </div>

        <div class="right-column" id="content1">
            <h2>URLs et Redirections</h2>
            <?php if (!empty($redirectionResults)): ?>
            <table>
                <thead>
                    <tr>
                        <th>URL Originale</th>
                        <th>Chemin de Redirection</th>
                        <th>Lien de Test</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($redirectionResults as $result): ?>
                    <tr>
                        <td><a href="<?= htmlspecialchars($result['originalLink']) ?>" class="url-link" target="_blank"><?= htmlspecialchars($result['originalLink']) ?></a></td>
                        <td><?= htmlspecialchars($result['urlPath']) ?></td>
                        <td><a href="<?= htmlspecialchars($_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/".$result['urlPath']) ?>" class="redirection-link" target="_blank"><?= htmlspecialchars($_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/".$result['urlPath']) ?></a></td>
                        <td>
                            <!-- Placeholders for Edit/Delete buttons -->
                            <a href="index.php?action=edit_redirect&id=<?= htmlspecialchars($result['redirectionId']) ?>">Modifier</a>
                            <a href="index.php?action=delete_redirect&id=<?= htmlspecialchars($result['redirectionId']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette redirection ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>Vous n'avez pas encore de redirections configurées.</p>
            <?php endif; ?>
        </div>
    </div>
    </main>
<?php $content = ob_get_clean(); ?>
<?php require_once('templates/layout.php'); ?>
