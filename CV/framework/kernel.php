<?php

namespace Framework;

use Exception;
use Framework\Autoloader\Autoloader;
use Framework\Databases\PDOHandler;
use Framework\Databases\Query;
use Framework\Databases\QueryHandler;
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
    include __DIR__ . '/Autoloader/Autoloader.php';
    Autoloader::default(APP['namespace'], APP['autoloader']);

    /**
     * start DevMod
     */
    if (true === DEV)
        DevMod::getInstance();

    /**
     * Build connections DB
     */
    foreach (APP['PDO_connect'] as $tag => $DBConnectArgs) {
        PDOHandler::openInstance($tag, ...$DBConnectArgs);
        // $PDO = PDOHandler::getInstance($tag);
    }



    Query::on()
        ->getRequest('SELECT title,content FROM pages WHERE urlid = :nest;')
        ->nest(
            'nest',
            Query::on()
                ->getRequest('SELECT id FROM urls WHERE url = :url')
                ->getData(['url' => 'accueil.html'])
        )
        ->execute()
        ->fetchAllCall(
            function ($row, $data) {


                var_dump($data);
            },
            \PDO::FETCH_ASSOC
        );






    // var_dump($queryhandler);
    // echo '<pre>' . print_r($data, 1) . '</pre></br>';


    // $data = Query::on()
    //     ->getRequest('DESCRIBE pages;')
    //     ->execute()
    //     ->fetch(true, null);


    // var_dump($queryhandler);
    // echo '<pre>' . print_r($data, 1) . '</pre></br>';

    // that ok ! 

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
