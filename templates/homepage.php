<?php $title = "Home - Création de redirection" ?>

<?php ob_start(); ?>
    <p> Bienvenue dans ma solution </p>
<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php'); ?>