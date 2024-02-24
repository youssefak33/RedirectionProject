<?php 

require_once ('src/lib/database.php');

function createAccount (string $userName, string $userEmail, string $userPassword) 
{
    $database = linkDbConnect();
    $statement = $database->prepare (
        'INSERT INTO user(name, email, password ) VALUES (?, ?, ?)'
    );
    $affectedLines = $statement->execute([$userName, $userEmail, $userPassword]);
    return $affectedLines > 0;
}