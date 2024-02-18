<?php 
// create function that require form
// get in parameter an input array 
// check if not empty 

require_once('src/models/links_add.php');

function addLink ($link, $scriptHead, $scriptBody) {
    $originalLink = null;
    $scriptHeadTracking = null;
    $scriptBodyTracking = null;
    if (!empty($link) && !empty($scriptHead) && !empty($scriptBody)) {
        $originalLink = $link;
        $scriptHeadTracking = $scriptHead;
        $scriptBodyTracking = $scriptBody;
    } else{
        throw new Exception ('le lien et script n\'ont pas été ajoutés');
    }
    
    $success = linkAdded($originalLink, $scriptHeadTracking, $scriptBodyTracking);
    if (!$success) {
        redirects_add();
    } else {
        redirects_add($thankYouMessage = "Merci pour votre soumission!");
    }
}