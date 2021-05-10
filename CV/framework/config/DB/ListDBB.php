<?php

/**
 * Exemple default 
 */
return [
    // DB identifier
    'MyDB' => [
        // DB identifier
        'dbtype' => 'mysql',

        // mysqli / PDO, etc. 
        'DBhandler' => '\PDO',

        // dbname
        'dbname' => 'mydb',

        // hostname 
        'hostname' => 'localhost',

        // app connect
        'login' => 'dev',
        'password' => 'dev',

        // charsets to use
        'charset' => 'utf8mb4-general-ci',
        'collation' => 'utf8mb4-general-ci',

        // connected object
        'singleton' => null,
    ],
];
