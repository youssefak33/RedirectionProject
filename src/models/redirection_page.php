<?php

require_once('src/lib/database.php');

function selectElementRedirection() {
    if (empty($_SESSION['user']) || empty($_SESSION['user']['id'])) {
        return []; // Return empty array if no user session or user ID
    }

    $database = linkDbConnect();
    // Select redirection_id and link_id, use table aliases
    $statement = $database->prepare(
        "SELECT 
            lt.original_link, 
            lt.script_head, 
            lt.script_body, 
            ur.url_path,
            ur.redirection_id,  -- Added
            lt.link_id          -- Added
        FROM link_tracking lt
        JOIN url_redirection ur ON lt.link_id = ur.link_tracking_id
        WHERE lt.user_account_id = :user_id" // Simplified JOIN as user_id is in link_tracking
    );
    // Bind user_id as INT
    $statement->bindValue(":user_id", $_SESSION['user']['id'], PDO::PARAM_INT);

    $statement->execute();

    $redirections = [];
    // Fetch as associative array
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $redirections[] = [
            'originalLink' => $row['original_link'],
            'scriptHead' => $row['script_head'],
            'scriptBody' => $row['script_body'],
            'urlPath' => $row['url_path'],
            'redirectionId' => $row['redirection_id'], // Now available
            'linkId' => $row['link_id']             // Now available
        ];
    }
    return $redirections;
}

// Populate $redirectionResults, ensuring it's an array even if function returns null
$redirectionResults = selectElementRedirection() ?? [];

?>
