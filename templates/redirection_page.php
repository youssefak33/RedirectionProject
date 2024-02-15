<?php 
    require_once('src/controllers/redirection_page.php')
?>

<!DOCTYPE html>
<head>
    <?= $scriptHead ?>
</head>
<body>
    <?= $scriptBody ?>
    <script>
    // Utilisation de la variable PHP dans JavaScript
    var maVariableJS = <?php echo json_encode($originalLink); ?>;
    console.log(maVariableJS);

    window.location.href = 'https://'+maVariableJS;
    </script>
</body>
</html>