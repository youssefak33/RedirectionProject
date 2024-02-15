<?php

require_once('src/controllers/redirects_add.php');
require_once('src/controllers/redirects.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/redirection_page.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'domains') {
            require('templates/domains.php');;
        }
        elseif ($_GET['action'] === 'redirects') {
            if (isset($_POST['link']) && isset($_POST['script'])){
                $link = $_POST['link'];
                $script = $_POST['script'];
                addLink ($link, $script);
            } else {
                redirects_add();
            }
        }
        elseif ($_GET['action'] === $urlPath) {
            redirectionPage();
        }
        else {
            throw new Exception('page non existante');
        }   
}    else {
        homepage();
}    
}   catch (Exception $e) {
    $errorMessage = $e->getMessage();
    die($errorMessage);
}
