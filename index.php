<?php

require_once('src/controllers/redirects_add.php');
require_once('src/controllers/redirects.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/redirection_page.php');
require_once('src/controllers/links.php');
require_once ('src/controllers/signup.php');
require_once ('src/controllers/signup_action.php');
require_once('src/controllers/login.php');

$connected = 1;
try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($connected === 0) {
            if ($_GET['action'] === 'domains') {
                linksPage ($redirectionResults);
            }
            elseif ($_GET['action'] === 'redirects') {
                if (isset($_POST['link']) && isset($_POST['script_head']) && isset($_POST['script_body'])){
                    $link = $_POST['link'];
                    $scriptHead = $_POST['script_head'];
                    $scriptBody = $_POST['script_body'];
                    addLink ($link, $scriptHead, $scriptBody);
                } else {
                    redirects_add();
                }
            }
            elseif (isset($_GET['action'])) {
                foreach ($redirectionResults as $result) {
                    if (isset($result['urlPath']) && $_GET['action'] === $result['urlPath']) {
                        redirectionPage($result);
                        break;  // stop the looop after finding the path 
                    }
                    else {
                        throw new Exception('page non existante');
                    }
                }
            }
            else {
                throw new Exception('page non existante');
            }
        }
        elseif ($connected === 1 && $_GET['action'] === 'connexion') {
            loginPage();
        }
        elseif ($connected === 1 && $_GET['action'] === 'account_creation') {
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST["signup_pass"])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $signupPass = $_POST['signup_pass'];
                addUser ($name, $email, $signupPass);
            }
            else {
                signUp ();
            }
        }
        elseif (isset($_GET['action'])) {
            foreach ($redirectionResults as $result) {
                if (isset($result['urlPath']) && $_GET['action'] === $result['urlPath']) {
                    redirectionPage($result);
                    break;  // stop the looop after finding the path 
                }
                else {
                    header('Location: connexion');
                    exit();
                }  
            }
        }
        else {
            header('Location: connexion');
            exit();
        }   
    }
    else {
            homepage();
    }    
}   catch (Exception $e) {
    $errorMessage = $e->getMessage();
    die($errorMessage);
}