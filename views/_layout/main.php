<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($title ?? '') . ' ' . $_ENV['SITE_NAME'] ?></title>
    <link rel="stylesheet" href="/css/output.css?v=<?php if ($_ENV['DEV_MODE'] == "true") {
                                                        echo time();
                                                    }; ?>">
</head>

<body class="bg-primary">
    <nav class="flex justify-center items-center">
        <div class="brand">Fixit Aalst</div>
        <div class="w-max flex gap-3 bg-tertiary text-[#f8f8ff] rounded-2xl py-3 px-5">
            <a href="/">Dashboard</a>
            <a href="/addPart">Add new part</a>
            <a href="/addRepair">Add new repair</a>
            <a href="/repairs">This months repairs</a>
            <a href="/parts">Parts</a>
        </div>

    </nav>

    <main class="w-9/12 m-auto">
        <?= $content; ?>
    </main>

    <footer>
        &copy; <?= date('2009'); ?> - Fixit Aalst
    </footer>
</body>

</html>