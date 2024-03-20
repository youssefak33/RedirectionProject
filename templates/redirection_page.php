<!DOCTYPE html>
<head>
    <?= $redirectionResults['scriptHead'] ?>
</head>
<body>
    <?= $redirectionResults['scriptBody'] ?>
    <script>
    var originalUrl = <?php echo json_encode($redirectionResults['originalLink']); ?>;
    if (originalUrl.startsWith('https://')) {
        window.location.href = originalUrl;
    }
    else {
    window.location.href = "https://"+originalUrl;
    }
    </script>
</body>
</html>