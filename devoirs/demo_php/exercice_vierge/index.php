<?php
    ini_set('display_errors', '1');
    $pages = include 'data/pages.php';
    // var_dump($liste_pages);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mon super site </title>

    <!-- le css ici -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- fetch ? -->
    <script src="assets/js/fetch.js" defer></script>

</head>

<body>

    <header>
        <h1>
            Ma super page
        </h1>
    </header>

    <nav>
    <?php 
        foreach($pages as $row){
            if ( $row['url'] != '404.html') {
                ?>
                <a href="?page=<?php echo $row['url']; ?>"> <?php echo $row['title']; ?> </a>
               <?php
            }

            if($_GET['page'] == $row['url']) {
                $page_demande = $row;
            }
            else {

            }

        }
    ?>
    </nav>

    <main class="frow">

        <article>
            <h2>
                <?php 
                    echo $page_demande['title'];
                ?>

            </h2>
           
            <p>
                <?php 
                    echo $page_demande['content'];
                ?>
            
            </p>
            <hr>
                
                <?= $page_demande['author']; ?>
                <?= date('d/m/y H:m:s' ,$page_demande['publication']); ?>
            
        </article>

        <aside class="fcol">
            <div class="widget"> Widget 1 </div>
            <div class="widget"> Widget 2 </div>
        </aside>
    </main>

    <?php
        include 'footer.php';
    ?>
</body>

</html>