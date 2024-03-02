<?php

require_once('src/lib/database.php');

// and insert the data 
function linkAdded(string $originalLink, string $scriptHeadTracking, string $scriptBodyTracking)
{
    $database = linkDbConnect();
    $statement = $database->prepare(
        'INSERT INTO link_tracking(original_link, script_head, script_body, user_account_id) VALUES(?, ?, ?, ?)'
    );
    $affectedLines = $statement->execute([$originalLink, $scriptHeadTracking, $scriptBodyTracking, $_SESSION['user']['id']]);

    return ($affectedLines > 0);
}