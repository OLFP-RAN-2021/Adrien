<?php

// penser à créer une classe de debbugage
ini_set('display_errors', '1');

/**
 * Build Constante from App config.json
 * 
 * // penser à créer AppHandler class
 *      -> doit vérifier intégriter config
 */
define('APP', include_once 'App/config/app.php');

/**
 * Include Autoloader
 * Registre namspaces whith folders
 */
include __DIR__ . '/Autoloader/Autoloader.php';
Autoloader\Autoloader::register(
    ['Vendor', 'Framework', APP['autoloader']]
);

/**
 * Absolute path : call getcwd();
 * ex : ABSPATH = /srv/http/html 
 * 
 * Relative path (relative to DocumentRoot)
 * ex : RELPATH = domain.com/ [sub/folder/] app/assets/...
 */
Router\Router::default();
