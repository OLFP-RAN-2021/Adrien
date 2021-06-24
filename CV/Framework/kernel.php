<?php

namespace Framework;

use DOMDocument;
use Framework\Autoloader\DefaultAutoloader;
use Framework\Databases\PDOHandler;
use Framework\Databases\Query;
use Framework\Databases\SQL;
use Framework\Databases\SQLFluentsQueries\AddColumnChar;
use Framework\Databases\SQLFluentsQueries\AddColumnDouble;
use Framework\Databases\SQLFluentsQueries\AddColumnForeign;
use Framework\Databases\SQLFluentsQueries\AddColumnJSON;
use Framework\Databases\SQLFluentsQueries\AddColumnPrimary;
use Framework\DevMod;
use Framework\Router\Router;

use const Framework\Databases\ON_DELETE_DEFAULT;
use const Framework\Databases\ON_UPDATE_DEFAULT;
use const Framework\Databases\ON_UPDATE_STRICT;

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
     *  Build connections DB
     *  
     */
    foreach (APP['PDO_connect'] as $tag => $DBConnectArgs) {
        PDOHandler::openInstance($tag, ...$DBConnectArgs);
        // $PDO = PDOHandler::getInstance($tag);
    }

    // Query::on()
    //     ->createTableIfNotExists(
    //         'user_registre',
    //         [
    //             new AddColumnPrimary('id'),
    //             new AddColumnChar('login', 50),
    //         ]
    //     )
    //     ->execute()
    //     ->fetch();

    // Query::on()
    //     ->createTableIfNotExists(
    //         'users',
    //         [
    //             new AddColumnPrimary('id'),
    //             new AddColumnForeign('loginid', 'user_registre.id', SQL::ON_UPDATE_CASCADE, SQL::ON_DELETE_CASCADE),
    //             new AddColumnChar('password', 150),
    //             new AddColumnChar('email', 150),
    //             new AddColumnDouble('gps'),
    //             new AddColumnJSON('config'),
    //         ]
    //     )
    //     ->execute()
    //     ->fetch();

    // query::on()
    //     ->insert(
    //         'urls',
    //         [
    //             [null, 'test.html']
    //         ]
    //     )
    //     ->execute()
    //     ->fetch();

    // query::on()
    //     ->update(
    //         'urls',
    //         ['url' => 'test2.html']
    //     )
    //     ->where('url', SQL::EQUAL, 'test.html')
    //     ->execute()
    //     ->fetch();


    // query::on()
    //     ->delete('urls')
    //     ->where('url', SQL::EQUAL, 'test2.html')
    //     ->execute()
    //     ->fetch();

    // echo '<br><br><br>';

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
