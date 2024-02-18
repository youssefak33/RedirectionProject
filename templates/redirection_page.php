<?php 
    require_once('src/controllers/redirection_page.php')
?>

<!DOCTYPE html>
<head>
    <?= $redirectionResults['scriptHead'] ?>
</head>
<body>
    <?= $redirectionResults['scriptBody'] ?>
    <script>
    // Utilisation de la variable PHP dans JavaScript
    var originalUrl = <?php echo json_encode($redirectionResults['originalLink']); ?>;
    console.log(originalUrl);
    if (originalUrl.startsWith('https://')) {
        window.location.href = originalUrl;
    }
    else {
    window.location.href = "https://"+originalUrl;
    }
    </script>
</body>
</html>