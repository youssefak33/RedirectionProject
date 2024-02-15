<?php

// and insert the data 
function linkAdded(string $originalLink, string $scriptTracking)
{
    $database = linkDbConnect();
    $statement = $database->prepare(
        'INSERT INTO link_tracking(original_link, script) VALUES(?, ?)'
    );
    $affectedLines = $statement->execute([$originalLink, $scriptTracking]);

    return ($affectedLines > 0);
}

// we connect to the database
function linkDbConnect()
{
    try {
        $database = new PDO ('mysql:host=localhost;dbname=tackdirect;charset=utf8','root','root');
    }  catch (Exception $e)  {
            die('Erreur : '.$e->getMessage());
    }
    return $database;
}

