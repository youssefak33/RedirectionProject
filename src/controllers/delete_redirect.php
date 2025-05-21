<?php

require_once('src/models/links_manage.php');

function deleteRedirectController()
{
    if (empty($_SESSION['user']) || empty($_SESSION['user']['id'])) {
        header('Location: index.php?action=connexion'); // Redirect to login if not connected
        exit();
    }

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $redirectId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($redirectId === false || $redirectId === null) {
            // Invalid ID format
            $_SESSION['error_message'] = "L'identifiant de redirection fourni est invalide.";
            header('Location: index.php?action=domains');
            exit();
        }

        $success = deleteRedirectById($redirectId);

        if ($success) {
            $_SESSION['success_message'] = "La redirection a été supprimée avec succès.";
        } else {
            // You might want to log this error for diagnostics
            $_SESSION['error_message'] = "Erreur lors de la suppression de la redirection ou vous n'avez pas la permission.";
        }
    } else {
        $_SESSION['error_message'] = "Aucun identifiant de redirection fourni.";
    }

    header('Location: index.php?action=domains'); // Redirect back to the list
    exit();
}

?>
