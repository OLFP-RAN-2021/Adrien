<?php

namespace Framework;

use Framework\Autoloader\Autoloader;
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

define('RELPATH',   '/' . str_replace($_SERVER['DOCUMENT_ROOT'], '',  getcwd()));

define('PATHINFO', ($_SERVER['PATH_INFO'] ?? '/'));

/**
 * Build Constante from App config.json
 * 
 *  penser à créer AppHandler class
 *      -> doit vérifier intégriter config
 */
define('APP', include_once 'App/config/app.php');

/**
 * Include Autoloader PSR-4
 */
include __DIR__ . '/Autoloader/Autoloader.php';
Autoloader::default(APP['namespace'], APP['autoloader']);

/**
 * Initialize Routing
 */
$router = Router::getInstance();
$router->import(__DIR__ . '/Router/RouterDefault.php');
$router->route();

// Router::importBehaviour('');

// if (DEV === true) 
// DevMod::singleton();
