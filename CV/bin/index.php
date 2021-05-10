<?php



if (php_sapi_name() != 'cli') {
    echo "bin/console or bin/scr/cli.php (this file) MUST be run in console. <br>";
    die();
}
try {

    $phar = new Phar(__DIR__ . '/console.phar');

    if (Phar::canWrite()) {
        $phar->buildFromDirectory(__DIR__ . '/src');
        $phar->setStub($phar->createDefaultStub(dirname(__FILE__) . 'src/cli.php', null));
        // $phar->setStub($phar->createDefaultStub(dirname(__FILE__) . 'src/cli.php', null));
        // $phar = $phar->convertToExecutable(Phar::TAR, Phar::GZ);
        $phar->startBuffering();

        $phar->stopBuffering();

        // --
    } else {
        throw new Exception('Phar can\'t write console.phar');
    }

    // --
} catch (Exception $e) {
    var_dump($e);
}
