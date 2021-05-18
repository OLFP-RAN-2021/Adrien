<?php

namespace Framework;

use Exception;
use Framework\Autoloader\Autoloader;
use Framework\Autoloader\DefaultAutoload;
use Framework\Autoloader\DefaultAutoloader;
use Framework\Databases\PDOHandler;
use Framework\Databases\Query;
use Framework\DevMod;
use Framework\Router\Router;


/**
 * Enable DEV mod :
 *      printings errors
 *      monitoring,
 *      sync entities,
 *      etc.     
 */
define('DEV', true);

define('RELPATH', str_replace($_SERVER['DOCUMENT_ROOT'], '',  getcwd()));

define('PATHINFO', ($_SERVER['PATH_INFO'] ?? '/'));

/**
 * Build Constante from App config.json
 * 
 *  penser à créer AppHandler class
 *      -> doit vérifier intégriter config
 */
define('APP', include_once 'App/config/app.php');


try {

    /**
     * Include Autoloader PSR-4
     */
    include __DIR__ . '/Autoloader/Default.php';
    new DefaultAutoloader(APP['namespace'], APP['autoloader']);

    /**
     * start DevMod
     */
    if (true === DEV)
        DevMod::getInstance();



    /**
     * Build connections DB
     * 
     */
    foreach (APP['PDO_connect'] as $tag => $DBConnectArgs) {
        PDOHandler::openInstance($tag, ...$DBConnectArgs);
        // $PDO = PDOHandler::getInstance($tag);
    }

    // SELECT * FROM pages WHERE urlid = (SELECT id FROM urls WHERE url = accueil.html);
    $data = Query::on('pages')
        ->select('title, content')
        ->where('title', Query::Equal, 'accueil')
        ->nest(
            'urlid',
            Query::on('urls')
                ->select('id')
                ->where('url', Query::Equal, 'accueil.html')
            // ->dump()
        )
        ->execute()
        ->fetchAll(\PDO::FETCH_ASSOC);
    var_dump($data);

    echo '<br><br><br>';



    /**
     * Initialize Routing
     */
    $router = Router::getInstance();
    $router->import(__DIR__ . '/Router/RouterDefault.php');
    $router->route();

    // --
} catch (\Exception $error) {
    if (true === DEV) {
        Debbuger::getTException($error);
        Debbuger::printDebbug();
    }
}
