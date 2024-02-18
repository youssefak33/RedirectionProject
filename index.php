<?php

require_once('src/controllers/redirects_add.php');
require_once('src/controllers/redirects.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/redirection_page.php');
require_once('src/controllers/links.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
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
                    break;  // Arrêter la boucle après avoir trouvé la correspondance
                }
            }
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