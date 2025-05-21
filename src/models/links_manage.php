<?php

require_once('src/lib/database.php');

/**
 * Deletes a redirect.
 * Since url_redirection.link_tracking_id has ON DELETE CASCADE to link_tracking.link_id,
 * we should delete the link_tracking entry.
 * This function first finds the link_tracking_id associated with the redirection_id,
 * then deletes that link_tracking record.
 *
 * @param int $redirectionId The ID of the url_redirection to delete.
 * @return bool True on success, false on failure.
 */
function deleteRedirectById(int $redirectionId): bool
{
    $database = linkDbConnect();

    // First, get the link_tracking_id from the url_redirection table
    $statement = $database->prepare(
        "SELECT link_tracking_id FROM url_redirection WHERE redirection_id = :redirection_id"
    );
    $statement->bindValue(':redirection_id', $redirectionId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['link_tracking_id'])) {
        $linkTrackingId = $result['link_tracking_id'];

        // Now, delete the link_tracking entry. 
        // The ON DELETE CASCADE will handle deleting the url_redirection entry.
        $deleteStatement = $database->prepare(
            "DELETE FROM link_tracking WHERE link_id = :link_tracking_id AND user_account_id = :user_id"
        );
        // Ensure the link belongs to the current user for security
        $deleteStatement->bindValue(':link_tracking_id', $linkTrackingId, PDO::PARAM_INT);
        $deleteStatement->bindValue(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT); 
        
        return $deleteStatement->execute();
    }

    return false; // Redirection not found or link_tracking_id missing
}

/**
 * Fetches a single redirect's details for editing.
 * It retrieves information from both link_tracking and url_redirection tables.
 * Ensures the redirect belongs to the current logged-in user.
 *
 * @param int $redirectionId The ID of the url_redirection to fetch.
 * @return array|false The redirect details as an associative array, or false if not found or not owned by user.
 */
function getRedirectById(int $redirectionId): array|false
{
    if (empty($_SESSION['user']) || empty($_SESSION['user']['id'])) {
        return false; 
    }

    $database = linkDbConnect();
    $statement = $database->prepare(
        "SELECT 
            lt.link_id,
            lt.original_link, 
            lt.script_head, 
            lt.script_body, 
            ur.url_path,
            ur.redirection_id
        FROM link_tracking lt
        JOIN url_redirection ur ON lt.link_id = ur.link_tracking_id
        WHERE ur.redirection_id = :redirection_id AND lt.user_account_id = :user_id"
    );
    $statement->bindValue(':redirection_id', $redirectionId, PDO::PARAM_INT);
    $statement->bindValue(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    
    $redirect = $statement->fetch(PDO::FETCH_ASSOC);

    return $redirect; // Returns the associative array or false if no record found
}

/**
 * Updates an existing redirect's details.
 *
 * @param int $redirectionId The ID of the url_redirection entry to update.
 * @param int $linkId The ID of the link_tracking entry to update.
 * @param string $originalLink The new original URL.
 * @param string $urlPath The new custom URL path.
 * @param string|null $scriptHead The new script for the head.
 * @param string|null $scriptBody The new script for the body.
 * @param int $userId The ID of the user performing the update.
 * @return bool True on success, false on failure.
 */
function updateRedirect(int $redirectionId, int $linkId, string $originalLink, string $urlPath, ?string $scriptHead, ?string $scriptBody, int $userId): bool
{
    $database = linkDbConnect();
    
    // Check if the url_path is already taken by another redirect
    $stmtCheckPath = $database->prepare("SELECT redirection_id FROM url_redirection WHERE url_path = :url_path AND redirection_id != :current_redirection_id");
    $stmtCheckPath->bindValue(':url_path', $urlPath, PDO::PARAM_STR);
    $stmtCheckPath->bindValue(':current_redirection_id', $redirectionId, PDO::PARAM_INT);
    $stmtCheckPath->execute();
    if ($stmtCheckPath->fetch()) {
        // This url_path is already in use by another redirect.
        $_SESSION['error_message'] = "Le chemin de redirection '$urlPath' est déjà utilisé par une autre redirection.";
        return false;
    }

    $database->beginTransaction();

    try {
        // Update link_tracking table
        $stmtLink = $database->prepare(
            "UPDATE link_tracking 
             SET original_link = :original_link, script_head = :script_head, script_body = :script_body 
             WHERE link_id = :link_id AND user_account_id = :user_id"
        );
        $stmtLink->bindValue(':original_link', $originalLink, PDO::PARAM_STR);
        $stmtLink->bindValue(':script_head', $scriptHead, PDO::PARAM_STR);
        $stmtLink->bindValue(':script_body', $scriptBody, PDO::PARAM_STR);
        $stmtLink->bindValue(':link_id', $linkId, PDO::PARAM_INT);
        $stmtLink->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $linkUpdated = $stmtLink->execute();

        if (!$linkUpdated || $stmtLink->rowCount() === 0) {
            // Rollback if link_tracking update failed or didn't affect any row (wrong user or link_id)
            $database->rollBack();
            $_SESSION['error_message'] = "Erreur lors de la mise à jour des détails du lien ou permission refusée.";
            return false;
        }

        // Update url_redirection table
        $stmtRedirect = $database->prepare(
            "UPDATE url_redirection 
             SET url_path = :url_path 
             WHERE redirection_id = :redirection_id"
            // We don't need to check user_id here again as we verified it with link_tracking
        );
        $stmtRedirect->bindValue(':url_path', $urlPath, PDO::PARAM_STR);
        $stmtRedirect->bindValue(':redirection_id', $redirectionId, PDO::PARAM_INT);
        $redirectUpdated = $stmtRedirect->execute();

        if (!$redirectUpdated) {
            // Rollback if url_redirection update failed
            $database->rollBack();
            $_SESSION['error_message'] = "Erreur lors de la mise à jour du chemin de redirection.";
            return false;
        }
        
        $database->commit();
        return true;

    } catch (PDOException $e) {
        $database->rollBack();
        // Check for unique constraint violation specifically for url_path
        if ($e->getCode() == '23000' && str_contains($e->getMessage(), 'url_path')) {
             $_SESSION['error_message'] = "Le chemin de redirection '$urlPath' est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            $_SESSION['error_message'] = "Erreur de base de données : " . $e->getMessage();
        }
        return false;
    }
}

?>
