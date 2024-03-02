<?php

require_once('src/lib/database.php');

// and insert the data 
function connectedUser()
{
    $database = linkDbConnect();

    $statement = $database->prepare(
        "SELECT * FROM `user` WHERE `email` = :email"
    );

    $statement->bindValue(":email", $_POST['email'], PDO::PARAM_STR);

    $statement->execute();

    $existedUser = $statement->fetch();

    if (!$existedUser) {
        echo "L'utilisateur n'existe pas";
    }
    elseif ($_POST['password'] != $existedUser['password']){ 
        echo "L'utilisateur n'existe pas";
    }
    else {
        session_start();
        $_SESSION["user"] = [
            "id" => $existedUser['user_id'],
            "username" => $existedUser['name'],
            "email" => $existedUser['email']
        ];
        header('Location: index.php');
    }
}
