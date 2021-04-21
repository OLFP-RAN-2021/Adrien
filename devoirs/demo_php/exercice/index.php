<?php

// penser à créer une classe de debbugage
ini_set('display_errors', '1');

/**
 * Include Autoloader
 * Registre namspaces whith folders
 */
include __DIR__ . '/vendor/Autoloader.php';
Autoloader::register(
    [
        'App\\' => 'src/includes/',
        'Vendor\\' => 'vendor/'
    ]
);


/**
 * Absolute path : call getcwd();
 * ex : ABSPATH = /srv/http/html 
 * 
 * Relative path (relative to DocumentRoot)
 * ex : RELPATH = domain.com/ [sub/folder/] app/assets/...
 */
Vendor\router\Router::default();


?>














<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mon super site </title>

    <!-- le css ici -->
    <link rel="stylesheet" href="<?= RELPATH ?>/src/assets/css/style.css">

    <!-- fetch ? -->
    <script src="<?= RELPATH ?>/src/assets/js/fetch.js" defer></script>

</head>

<body>

    <header>
        <h1>
            Ma super page
        </h1>
    </header>

    <nav>
        <?php

        ?>
        <a href="?page=<?php echo $row['url']; ?>"> <?php echo $row['title']; ?> </a>
        <?php

        ?>
    </nav>

    <main class="frow">

        <article>
            <h2>


            </h2>

            <p>


            </p>
            <hr>



        </article>

        <aside class="fcol">
            <div class="widget"> Widget 1 </div>
            <div class="widget"> Widget 2 </div>
        </aside>
    </main>

    <footer>

        <div class="title"> Boilley Adrien </div>

        <div class="frow">

            <?php
            $list = glob('src/assets/html/widgets/*.html');
            foreach ($list as $path) {
                include $path;
            }


            ?>
        </div>
    </footer>
</body>

</html>