<?php 
if (isset($_POST["action"])) {
    if ($_POST['action']==='notre-solution') {
        $title="Découvrez nos solutions";
    }
}
else {
    $title="Accueil";
}
?>
<?php ob_start(); ?>
<h1>Découvrez nos solutions</h1>
<section id="section-solution">
<p> Bienvenue dans notre solution </p>
<p>Notre application vous permet de surveiller le trafic d'URL sur lesquelles vous n'avez pas la main, telles que des liens Google Drive et autres. Maintenez un contrôle total même sur des ressources en ligne externes.</p>
<img src="templates/assets/visuel-redirection.jpeg" alt="Un visuel qui montre le scéma de la redirection">
<p>L'application est entièrement gratuite car elle ne prétend pas apporter une solution révolutionnaire. Sans cela, Youssef aurait sûrement demandé une somme considérable pour y accéder.</p>
</section>
<?php $content = ob_get_clean(); ?>
<?php require_once('templates/layout.php') ?>

