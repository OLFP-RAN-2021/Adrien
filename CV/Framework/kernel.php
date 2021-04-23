<?php

// penser à créer une classe de debbugage
ini_set('display_errors', '1');

/**
 * Include Autoloader
 * Registre namspaces whith folders
 */
include __DIR__ . '/Autoloader.php';
Autoloader::register(
    [
        '*' => ['Vendor', 'Framework'],
        'App\\' => 'App/src/includes',
    ]
);

/**
 * Absolute path : call getcwd();
 * ex : ABSPATH = /srv/http/html 
 * 
 * Relative path (relative to DocumentRoot)
 * ex : RELPATH = domain.com/ [sub/folder/] app/assets/...
 */
Router\Router::default();
