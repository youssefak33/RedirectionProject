<?php 

require_once ('src/models/signup.php');

function addUser ($name, $email, $signupPass) {
    $userName = null; 
    $userEmail = null; 
    $userPassword = null;
    if (!empty($name) && !empty($email) && !empty($signupPass))
    {
        $userName = $name; 
        $userEmail = $email; 
        $userPassword = $signupPass;
    }
    else {
        throw new Exception("Votre compte n'a pas été créé");
    }

$success = createAccount ($userName, $userEmail, $userPassword);

if (!$success) {
    $messageAccountCreation = "Désolé, il y a eu une erreur et votre compte n'a pas pu être créé";
    signUp ($messageAccountCreation);
}
else {
    $accountCreated = "Merci, votre compte a été créé. Veuillez vous connecter";
    require_once ('templates/login.php');
}
}