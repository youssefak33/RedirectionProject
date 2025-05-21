<?php

require_once('src/models/links_manage.php'); // For getRedirectById and later updateRedirect

function editRedirectPage()
{
    if (empty($_SESSION['user']) || empty($_SESSION['user']['id'])) {
        header('Location: index.php?action=connexion');
        exit();
    }

    $redirectId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($redirectId === false || $redirectId === null) {
        $_SESSION['error_message'] = "L'identifiant de redirection fourni est invalide pour la modification.";
        header('Location: index.php?action=domains');
        exit();
    }

    $redirect = getRedirectById($redirectId);

    if (!$redirect) {
        $_SESSION['error_message'] = "Redirection non trouvée ou vous n'avez pas la permission de la modifier.";
        header('Location: index.php?action=domains');
        exit();
    }

    // The actual edit form will be in templates/edit_redirect.php
    // We pass $redirect data to it.
    require('templates/edit_redirect.php');
}

// Placeholder for the update logic (Step 6)
// function updateRedirectController() { ... }

function updateRedirectSubmitController()
{
    if (empty($_SESSION['user']) || empty($_SESSION['user']['id'])) {
        header('Location: index.php?action=connexion');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $_SESSION['error_message'] = "Méthode de requête invalide.";
        header('Location: index.php?action=domains');
        exit();
    }

    // Validate and sanitize inputs
    $redirectionId = filter_input(INPUT_POST, 'redirection_id', FILTER_VALIDATE_INT);
    $linkId = filter_input(INPUT_POST, 'link_id', FILTER_VALIDATE_INT);
    $originalLink = filter_input(INPUT_POST, 'original_link', FILTER_SANITIZE_URL);
    $urlPath = filter_input(INPUT_POST, 'url_path', FILTER_SANITIZE_STRING); // Basic sanitize, more specific pattern check below
    $scriptHead = $_POST['script_head'] ?? null; // Allow empty, no complex tags usually
    $scriptBody = $_POST['script_body'] ?? null; // Allow empty

    // Basic validation
    if (!$redirectionId || !$linkId || !$originalLink || !$urlPath) {
        $_SESSION['error_message'] = "Données manquantes ou invalides pour la mise à jour.";
        // Redirect back to edit form if possible, or to domains
        header('Location: index.php?action=edit_redirect&id=' . ($redirectionId ?: ''));
        exit();
    }
    
    if (!filter_var($originalLink, FILTER_VALIDATE_URL)) {
        $_SESSION['error_message'] = "L'URL originale n'est pas valide.";
        header('Location: index.php?action=edit_redirect&id=' . $redirectionId);
        exit();
    }

    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $urlPath)) {
        $_SESSION['error_message'] = "Format du chemin de redirection invalide. Utilisez uniquement des lettres, chiffres, tirets et underscores.";
        header('Location: index.php?action=edit_redirect&id=' . $redirectionId);
        exit();
    }
    
    // Get user ID from session
    $userId = $_SESSION['user']['id'];

    $success = updateRedirect($redirectionId, $linkId, $originalLink, $urlPath, $scriptHead, $scriptBody, $userId);

    if ($success) {
        $_SESSION['success_message'] = "Redirection mise à jour avec succès.";
        header('Location: index.php?action=domains');
    } else {
        // Error message is expected to be set by updateRedirect function in case of specific errors (like duplicate url_path)
        if (empty($_SESSION['error_message'])) { // Generic fallback
            $_SESSION['error_message'] = "Erreur lors de la mise à jour de la redirection.";
        }
        header('Location: index.php?action=edit_redirect&id=' . $redirectionId);
    }
    exit();
}

?>
