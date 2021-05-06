<!DOCTYPE html>
<html lang="<?= $this->lang ?>">

<head>
    <meta charset="<?= $this->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>

    <!-- include metas -->
    <?php
    foreach ($this->metasList as $meta) {
        $string = '<meta ';
        // a meta is array or traversable object.
        foreach ($meta as $prop => $value) {
            $string .= "$prop = \"$value\" ";
        }
        echo $string . '>';
    }
    ?>

    <!-- include CSS files -->
    <?php
    foreach ($this->cssFiles as $file) {
    ?>
        <link rel="stylesheet" href="<?= RELPATH . $file ?>" type="text/css">
    <?php
    }
    ?>

    <!-- include defered JS modules -->
    <?php
    foreach ($this->jsMuduleFiles as $file) {
    ?>
        <script type="module" defer>
            import './'.<?= $file ?>;
        </script>
    <?php
    }
    ?>

</head>

<body>

    <?php
    // if (isset($this->body)) {
    //     foreach ($this->body as $element) {
    //     }
    //     $recursive = function ($recusrive, $element) {
    //         $string = '<' . $element['tagname'] . ' ';
    //         if (is_array($element['content'])) {
    //             $string .= $recusrive($element['content']);
    //         }
    //         return $string . '</' . $element['tagname'] . '>';
    //     };
    // }
    ?>

    <!-- <header>
    </header>
    <nav>
    </nav>
    <main>
    </main>
    <footer>
    </footer> -->
</body>

</html>