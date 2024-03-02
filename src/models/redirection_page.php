<?php

require_once('src/lib/database.php');

function selectElementRedirection() {
    if (!empty($_SESSION['user'])) {
        $database = linkDbConnect();
        $statement = $database->prepare(
            "SELECT * 
            FROM link_tracking
            JOIN url_redirection ON link_tracking.link_id = url_redirection.link_tracking_id
            JOIN user ON user.user_id = link_tracking.user_account_id WHERE user_id = :user_id"
        );
        $statement->bindValue(":user_id", $_SESSION['user']['id'], PDO::PARAM_STR);

        $statement->execute();

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
}

$redirectionResults = selectElementRedirection();
