<?php
return [
    // 
    "name" => "MyApp",

    // app description
    "description" => "Ma super App !",

    // app owner
    "owner" => "Boilley Adrien",

    // licence
    "licence" => "MIT Licence",

    // namespace
    "namespace" => "App",

    // autoloader folder
    "autoloader" => "App/src/includes",

    // 
    "router" => [
        // 
        "controllers" => "App\\controllers\\",
        "default" => [
            "call" => "App\\controllers\\Page",
            "args" => ["home.html"]
        ],
        "behavior" => ""
    ],

    "PDO_connect" => [

        'MyAppDB' => [

            // db name
            'myApp',

            // hostname 
            'localhost',

            // login
            'dev',

            // password
            'dev',

            // db type
            'mysql',

            // charset
            'utf8mb4-general-ci',

            // collation
            'utf8mb4-general-ci',
        ],
    ]


];
