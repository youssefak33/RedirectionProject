<?php 
// require login model 
// call connected function 
// if not true send the connexion template 
// otherwise nothing 

function loginPage () {
    $accountCreated = "Se connecter à Trackdirect";
    require_once ('templates/login.php');
}