<?php $title = "Erreur 404 - Page non trouvée" ?>
<?php ob_start(); ?>
    <section id="page-introuvable">
        <h1>Erreur 404 - Page non trouvée</h1>
        <p id="number404"> 404 </p>
        <p>Désolé, la page que vous recherchez semble introuvable.</p>
        <p>Retournez à la home <a href="/">page d'accueil</a>.</p>
    </section>
<?php $content = ob_get_clean(); ?>
<?php require_once('templates/layout.php'); ?>
