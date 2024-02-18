<?php $title="Page de connexion"?>
<?php ob_start(); ?>
    <form action="index.php?action=connexion" method="post">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" maxlength="535" required autocomplete="off">

        <label for="mdp">Mot de passe</label>
        <input type="password" id="pass" name="password" minlength="8" required />
        
        <button type="submit">Se connecter</button>
    </form>
<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php') ?>
