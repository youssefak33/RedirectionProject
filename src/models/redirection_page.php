<?php

require_once('src/lib/database.php');

function selectElementRedirection()
{
    $database = linkDbConnect();
    $statement = $database->query(
        "SELECT * 
         FROM link_tracking
         JOIN url_redirection ON link_tracking.link_id = url_redirection.link_tracking_id"
    );

    $redirections = [];
    while ($row = $statement->fetch()) {
        $redirection = [
            'originalLink' => $row['original_link'],
            'scriptHead' => $row['script_head'],
            'scriptBody' => $row['script_body'],
            'urlPath' => $row['url_path'],
        ];
        $redirections[] = $redirection;
    }
    return $redirections;
}

// Appel de la fonction
$redirectionResults = selectElementRedirection();
