<header>
    <div class ="logo">
    <a href="index.php"><img src="templates/assets/logo.jpg" alt="Logo TrackDirect"></a>
    </div>
    <nav class="menu">
        <?php if (!empty($_SESSION['user']['username']) && !empty($_SESSION['user']['email'])) : ?>
        <a href="index.php?action=domains">Domaines de tracking</a>
        <a href="index.php?action=redirects">Ajouter une redirection trackée</a>
        <?php endif ?>
        <a href="index.php?action=notre-solution">Découvrez notre solution</a>
        <a href="index.php?action=apropos">A propos</a>
    </nav>
    <div class="connexion">
        <?php if (empty($_SESSION['user']['username']) && empty($_SESSION['user']['email'])) : ?>
        <a id="button-header" href="index.php?action=connexion">Connexion </a>
        <a id="button-header" href="index.php?action=account_creation">Créer votre compte </a>
        <?php else : ?>
        <a id="button-header" href="index.php?action=profile">Profil </a>
        <a id="button-header" href="index.php?action=deconnexion">Déconnexion </a>
        <?php endif ?>
    </div>
</header>