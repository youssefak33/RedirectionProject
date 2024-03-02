<header>
    <div class ="logo">
    <a href="index.php"><img src="templates/assets/logo.jpg" alt="Logo TrackDirect"></a>
    </div>
    <nav class="menu">
        <?php if (!empty($_SESSION['user']['username']) && !empty($_SESSION['user']['email'])) : ?>
        <a href="/www/Trackdirect/domains">Domaines de tracking</a>
        <a href="/www/Trackdirect/redirects">Ajouter une redirection trackée</a>
        <?php endif ?>
        <a href="/www/Trackdirect/notre-solution">Découvrez notre solution</a>
        <a href="/www/Trackdirect/apropos">A propos</a>
    </nav>
    <div class="connexion">
        <?php if (empty($_SESSION['user']['username']) && empty($_SESSION['user']['email'])) : ?>
        <a id="button-header" href="<?=dirname($_SERVER['SCRIPT_NAME'])."/connexion"?>">Connexion </a>
        <a id="button-header" href="<?=dirname($_SERVER['SCRIPT_NAME'])."/account_creation"?>">Créer votre compte </a>
        <?php else : ?>
        <a id="button-header" href="<?=dirname($_SERVER['SCRIPT_NAME'])."/profil"?>">Profil </a>
        <a id="button-header" href="<?=dirname($_SERVER['SCRIPT_NAME'])."/deconnexion"?>">Déconnexion </a>
        <?php endif ?>
    </div>
</header>