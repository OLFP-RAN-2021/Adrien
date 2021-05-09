<?php


do {
    print <<<BASH
    Welcome on console.
    Please be carefful.
    ---------------------------------
    DBMakeDiff : make diff between DB and copy project.
    ---------------------------------
    exit : exit.

BASH;


    $cmd = readline("DO : ");

    switch ($cmd) {
        case 'exit':
            break (2);
        default:
            print "Command don't exist.";
            break;
    }
} while (true);
