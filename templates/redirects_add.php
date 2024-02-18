<?php $title="Formulaire de lien et de script"?>
    <?php ob_start(); ?>
    <main>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $thankYouMessage = "Merci pour votre soumission!";
    }
    ?>
    <?php if (isset($thankYouMessage)) : ?>
        <p><?= $thankYouMessage; ?></p>
    <?php else : ?>
        <form action="index.php?action=redirects" method="post">
            <label for="lien">Lien :</label>
            <input type="text" id="link" name="link" maxlength="535" required autocomplete="off">

            <label for="script_head">Script dans le Head:</label>
            <textarea id="script_head" name="script_head" rows="4" required autocomplete="off"></textarea>

            <label for="script_body">Script dans le Body:</label>
            <textarea id="script_body" name="script_body" rows="4" autocomplete="off"></textarea>

            <button type="submit">Soumettre</button>
        </form>
    <?php endif; ?>
    </main>
    <?php $content = ob_get_clean(); ?>
    <?php require('templates/layout.php') ?>
