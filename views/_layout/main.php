<!DOCTYPE html>
<html lang="en" class="bg-gray-300">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($title ?? '') . ' ' . $_ENV['SITE_NAME'] ?></title>
    <link rel="stylesheet" href="/css/output.css?v=<?php if( $_ENV['DEV_MODE'] == "true" ) { echo time(); }; ?>">
</head>
<body>
    <div class="brand">Fixit Aalst</div>

    <main>
        <?= $content; ?>
    </main>
    
    <footer>
        &copy; <?= date('2009'); ?> - Fixit Aalst
    </footer>
</body>
</html>