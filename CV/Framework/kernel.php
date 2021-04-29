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

/**
 * Insert config app like
 *      $namespace => $folder
 */
Autoloader::loadConfig(
    [
        APP['namespace'] => APP['autoloader'],
    ]
);

// 
Autoloader::register();

/**
 * Get DevMod class in singleton. 
 *  
 */
if (DEV === true)
    DevMod::singleton();

/**
 * Absolute path : call getcwd();
 * ex : ABSPATH = /srv/http/html 
 * 
 * Relative path (relative to DocumentRoot)
 * ex : RELPATH = domain.com/ [sub/folder/] app/assets/...
 */
Router::default();

// if (DEV === true) 
// DevMod::singleton();
