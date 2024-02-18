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
    var maVariableJS = <?php echo json_encode($redirectionResults['originalLink']); ?>;
    console.log(maVariableJS);

    window.location.href = maVariableJS;
    </script>
</body>
</html>