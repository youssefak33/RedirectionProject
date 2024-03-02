<?php 

require_once ('src/lib/database.php');
function createAccount (string $userName, string $userEmail, string $userPassword) {
    try {
        $database = linkDbConnect();
        $statement = $database->prepare (
            'INSERT INTO user(name, email, password ) VALUES (?, ?, ?)'
        );
        $affectedLines = $statement->execute([$userName, $userEmail, $userPassword]);
        return $affectedLines > 0;
        $userEmail = null;
    }
    catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $messageAccountCreation = "Veuillez créer votre en compte en renseignant les informations ci-dessous";
            $usedEmail = "L'addresse email saisie est déjà utilisée";
            require_once ('templates/signup.php');
        } else {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
}
