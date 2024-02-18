<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link href="templates/style.css" rel="stylesheet">
    <link href="templates/script.js" rel="script">

</head>
<body>
    <?php require_once('templates/header.php')?>
    <main>
    <?= $content ?>
    </main>
    <?php require_once('templates/footer.php')?>
</body>
</html>
