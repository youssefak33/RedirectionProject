<?php 
// create function that require form
// get in parameter an input array 
// check if not empty 

require_once('src/models/model.php');

function addLink ($link, $script) {
    $originalLink = null;
    $scriptTracking = null;
    if (!empty($link) && !empty($script)) {
        $originalLink = $link;
        $scriptTracking = $script;
    } else{
        throw new Exception ('le lien et script n\'ont pas été ajoutés');
    }
    
    $success = linkAdded($originalLink, $scriptTracking);
    if (!$success) {
        redirects_add();
    } else {
        redirects_add($thankYouMessage = "Merci pour votre soumission!");
    }
}