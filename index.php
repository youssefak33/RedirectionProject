<?php

session_start();

require_once('src/controllers/redirects_add.php');
require_once('src/controllers/redirects.php');
require_once('src/controllers/redirection_page.php');
require_once('src/controllers/links.php');
require_once ('src/controllers/signup.php');
require_once ('src/controllers/signup_action.php');
require_once('src/controllers/login.php');
require_once('src/controllers/sign_in.php');
require_once('src/controllers/logout.php');
require_once('src/controllers/solution_page.php');
require_once('src/controllers/about_us.php');
require_once('src/controllers/delete_redirect.php');
require_once('src/controllers/edit_redirect.php');
require_once('src/controllers/profile.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if (!empty($_SESSION['user']['username']) && !empty($_SESSION['user']['email'])) {
            if ($_GET['action']=== '' OR $_GET['action']=== 'notre-solution') {
                solutionPage();
            }
            elseif ($_GET['action'] === 'domains') {
                linksPage ($redirectionResults);
            }
            elseif ($_GET['action'] === 'redirects') {
                if (isset($_POST['link']) && isset($_POST['script_head']) && isset($_POST['script_body'])){
                    $link = htmlspecialchars($_POST['link']);
                    $scriptHead = htmlspecialchars($_POST['script_head']);
                    $scriptBody = htmlspecialchars($_POST['script_body']);
                    addLink ($link, $scriptHead, $scriptBody);
                } else {
                    redirects_add();
                }
            }
            elseif ($_GET['action'] === 'deconnexion') {
                logoutUser();
            }
            elseif ($_GET['action'] === 'profile') { 
                profilePageController();
            }
            elseif ($_GET['action']==='apropos') {
                aboutUs();
            }
            elseif ($_GET['action'] === 'delete_redirect') {
                deleteRedirectController();
            }
            elseif ($_GET['action'] === 'edit_redirect') {
                editRedirectPage();
            }
            elseif ($_GET['action'] === 'update_redirect_submit') {
                updateRedirectSubmitController(); // Handles the form submission for edit
            }
            elseif (isset($_GET['action'])) {
                $findUrlPath = false;
                foreach ($redirectionResults as $result) {
                    if ($_GET['action'] === $result['urlPath']) {
                        redirectionPage($result);
                        $findUrlPath = true;
                        break;  
                    }
                }
                if (!$findUrlPath) {
                    require_once('templates/404.php');
                }
            }
            else {
                throw new Exception('page non existante');
            }
        }
        else {
            if ($_GET['action'] === 'connexion') {
                if (isset($_POST['email']) && isset($_POST['password'])) {
                    $emailLogin = htmlspecialchars($_POST['email']);
                    $passwordLogin = htmlspecialchars($_POST['password']);
                    signIn($emailLogin, $passwordLogin);
                }
                else {
                    loginPage();
                }
            }
            elseif ($_GET['action'] === 'account_creation') {
                if (isset($_POST['name']) && isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && isset($_POST["signup_pass"])) {
                    $name = htmlspecialchars($_POST['name']);
                    $email = htmlspecialchars($_POST['email']);
                    $signupPass = password_hash($_POST['signup_pass'], PASSWORD_ARGON2ID);
                    addUser ($name, $email, $signupPass);
                }
                else {
                    signUp ();
                }
            }
            elseif ($_GET['action'] === 'notre-solution') {
                solutionPage();
            }
            elseif ($_GET['action']==='apropos') {
                aboutUs();
            }
            elseif (isset($_GET['action'])) {
                $findUrlPath = false;
                if (is_array($redirectionResults) && !empty($redirectionResults)) {
                    foreach ($redirectionResults as $result) {
                        if (isset($_GET['action']) && $_GET['action'] === $result['urlPath']) {
                            redirectionPage($result);
                            $findUrlPath = true;
                            break;  
                        }
                    }
                } else {
                    require_once('templates/404.php');
                }
            }         
            else {
                header('Location: connexion');
                exit();
            }
        }   
    }
    else {
        solutionPage();
    }
}    
catch (Exception $e) {
$errorMessage = $e->getMessage();
die($errorMessage);
}