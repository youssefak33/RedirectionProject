<?php $title="Page de connexion"?>
<?php ob_start(); ?>

    <h2> <?= $accountCreated ?></h2>

    <form action="index.php?action=connexion" method="post">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" maxlength="535" required autocomplete="off">

        <label for="mdp">Mot de passe</label>
        <input type="password" id="pass" name="password" minlength="8" required />
        
        <button type="submit">Se connecter</button>
        <a href='index.php?action=account_creation'>Créer mon compte</a>
    </form>
<?php $content = ob_get_clean(); ?>
<?php require_once('templates/layout.php') ?>
