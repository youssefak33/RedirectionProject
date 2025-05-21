<?php

// No specific models needed for just displaying session data yet.
// require_once('src/models/user_profile.php'); // If we had profile-specific db operations

function profilePageController()
{
    if (empty($_SESSION['user']) || empty($_SESSION['user']['username']) || empty($_SESSION['user']['email'])) {
        // User data not found in session, redirect to login
        header('Location: index.php?action=connexion');
        exit();
    }

    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];

    // Potentially load more user details from a model if needed in the future.
    
    require('templates/profil.php');
}

?>
