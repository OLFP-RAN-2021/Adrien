<?php
return [
    "name" => "MyApp",
    "description" => "Ma suoer App !",
    "owner" => "Boilley Adrien",
    "licence" => "MIT Licence",
    "namespace" => "App",
    "autoloader" => "App/src/includes",
    "router" => [
        "controllers" => "App\\controllers\\",
        "default" => [
            "call" => "App\\controllers\\Page",
            "args" => ["home.html"]
        ],
        "behaviur" => ""
    ],


];
