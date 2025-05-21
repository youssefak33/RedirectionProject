<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link href="templates/style.css" rel="stylesheet">
    <script src="templates/script.js" defer></script>

</head>
<body>
    <?php 
        if (isset($_SESSION['error_message'])) {
            echo '<p style="color: red; text-align: center; background-color: #ffebee; padding: 10px; border-radius: 5px; border: 1px solid #ef9a9a;">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
            unset($_SESSION['error_message']);
        }
        if (isset($_SESSION['success_message'])) {
            echo '<p style="color: green; text-align: center; background-color: #e8f5e9; padding: 10px; border-radius: 5px; border: 1px solid #a5d6a7;">' . htmlspecialchars($_SESSION['success_message']) . '</p>';
            unset($_SESSION['success_message']);
        }
    ?>
    <?php require_once('templates/header.php')?>
    <main>
    <?= $content ?>
    </main>
    <?php require_once('templates/footer.php')?>
</body>
</html>
