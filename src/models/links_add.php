<?php

require_once('src/lib/database.php');

// and insert the data 
function linkAdded(string $originalLink, string $scriptHeadTracking, string $scriptBodyTracking)
{
    $database = linkDbConnect();
    $statement = $database->prepare(
        'INSERT INTO link_tracking(original_link, script_head, script_body) VALUES(?, ?, ?)'
    );
    $affectedLines = $statement->execute([$originalLink, $scriptHeadTracking, $scriptBodyTracking]);

    return ($affectedLines > 0);
}