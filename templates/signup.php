<?php $title = "Création de compte sur Trackdirect" ?>

<?php ob_start(); ?>

<h2>Création de compte</h2>

<form action="/account_creation" method="post">
  <label for="prenom">Votre nom:</label>
  <input type="text" id="name" name="name" required>

  <label for="email">Adresse e-mail :</label>
  <input type="email" id="email" name="email" required>

  <label for="motDePasse">Mot de passe :</label>
  <input type="password" id="signup_pass" name="signupPass" required>

  <label for="confirmerMotDePasse">Confirmer le mot de passe :</label>
  <input type="password" id="confirm_signup_pass" name="confirmSignupPass" required>

  <button type="submit">Créer le compte</button>
</form>

<?php $content = ob_get_clean();?>
<?php require_once('templates/layout.php') ?>