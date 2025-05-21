<?php $title = "Modifier la Redirection"; ?>
<?php ob_start(); ?>

<main>
    <div class="container">
        <h1>Modifier la Redirection</h1>

        <?php if (isset($redirect) && $redirect): ?>
        <form action="index.php?action=update_redirect_submit" method="post">
            <input type="hidden" name="redirection_id" value="<?= htmlspecialchars($redirect['redirection_id']) ?>">
            <input type="hidden" name="link_id" value="<?= htmlspecialchars($redirect['link_id']) ?>">

            <div>
                <label for="original_link">URL Originale :</label>
                <input type="url" id="original_link" name="original_link" value="<?= htmlspecialchars($redirect['original_link']) ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
            </div>

            <div>
                <label for="url_path">Chemin de Redirection Personnalisé :</label>
                <input type="text" id="url_path" name="url_path" value="<?= htmlspecialchars($redirect['url_path']) ?>" required pattern="[a-zA-Z0-9_-]+" title="Utilisez uniquement des lettres, chiffres, tirets et underscores." style="width: 100%; padding: 8px; margin-bottom: 10px;">
                <small>Exemple: `mon_lien_special`. Sera accessible via `<?= htmlspecialchars($_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])) ?>/mon_lien_special`</small>
            </div>

            <div>
                <label for="script_head">Script dans `<head>` (optionnel) :</label>
                <textarea id="script_head" name="script_head" rows="5" style="width: 100%; padding: 8px; margin-bottom: 10px;"><?= htmlspecialchars($redirect['script_head']) ?></textarea>
            </div>

            <div>
                <label for="script_body">Script au début de `<body>` (optionnel) :</label>
                <textarea id="script_body" name="script_body" rows="5" style="width: 100%; padding: 8px; margin-bottom: 10px;"><?= htmlspecialchars($redirect['script_body']) ?></textarea>
            </div>

            <button type="submit">Mettre à jour la redirection</button>
            <a href="index.php?action=domains">Annuler</a>
        </form>
        <?php else: ?>
        <p>Impossible de charger les données de redirection pour la modification.</p>
        <?php endif; ?>
    </div>
</main>

<?php $content = ob_get_clean(); ?>
<?php require_once('templates/layout.php'); ?>
