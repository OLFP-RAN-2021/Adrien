<?php

$data = [
    [
        "url" => 'accueil.html',
        "title" => 'Bienvenue !',
        "content" => 'Bienvenue mon super site.',
    ],
    [
        "url" => 'a-propos.html',
        "title" => 'A propos de moi.',
        "content" => 'A propos de ma petite personne.',
    ],
    [
        "url" => 'ma-page.html',
        "title" => 'Une page.',
        "content" => 'Une page quelconque.',
    ],
    [
        "url" => '404.html',
        "title" => 'Not found',
        "content" => 'Page non trouvée !',
    ],
];

/**
 * routage minimaliste
 */
if (empty($_GET['page']))
    $page = $data[0];
else
    foreach ($data as $page)
        if ($page['url'] == $_GET['page']) break;
        else $page = end($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>
            <?= $page['title'] ?>
        </h1>
    </header>
    <nav>
        <?php
        foreach ($data as $Element) :
            if ($Element['url'] != '404.html') :
        ?>
                <a href="?page=<?= $Element['url'] ?>"> <?= $Element['title'] ?> </a>
        <?php
            endif;
        endforeach;
        ?>
    </nav>

    <main>
        <?= $page['content'] ?>
    </main>
</body>

</html>