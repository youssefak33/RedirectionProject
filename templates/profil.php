<?php $title = "Mon Profil"; ?>
<?php ob_start(); ?>

<main>
    <div class="container">
        <h1>Mon Profil</h1>

        <?php if (isset($username) && isset($email)): ?>
        <div>
            <p><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($username) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($email) ?></p>
        </div>
        
        <!-- Placeholder for future profile actions like 'Edit Profile' or 'Change Password' -->
        <!-- 
        <div style="margin-top: 20px;">
            <a href="index.php?action=edit_profile">Modifier le profil</a> |
            <a href="index.php?action=change_password">Changer le mot de passe</a>
        </div>
        -->
        <?php else: ?>
        <p>Impossible de charger les informations du profil.</p>
        <?php endif; ?>
        
        <p style="margin-top: 30px;"><a href="index.php?action=domains">Retour à mes redirections</a></p>
    </div>
</main>

<?php $content = ob_get_clean(); ?>
<?php require_once('templates/layout.php'); ?>
