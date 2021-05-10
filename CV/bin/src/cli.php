<?php

$cmdList = [];
$cmdTxtList = '';
foreach (glob(__DIR__ . '/*', GLOB_ONLYDIR) as $fld) {
    foreach (glob($fld . '/cmd/*.php') as $cmdFile) {
        $cmd = substr(basename($cmdFile), 0, -4);
        $cmdTxtList .= "\n\t" . basename($fld) . ' ' . $cmd;
        $cmdList[basename($fld)][$cmd] = $cmdFile;
    }
}

array_shift($argv);
if (isset($argv[0])) {
    if (!isset($argv[1])) {
        echo "Command require option.\nSee " . $argv[0] . " help\n";
    } else if (isset($cmdList[$argv[0]][$argv[1]])) {
        $path = __DIR__ . '/' . array_shift($argv) . '/cmd/' . array_shift($argv) . '.php';
        $args = implode(' ', $argv);
        exec("php $path $args", $output);
        foreach ($output as $row)
            echo "$row\n";
    }
} else {
    print <<<BASH

    \tWelcome on console.
    \tPlease be carefful.
    ---------------------------------$cmdTxtList
    ---------------------------------
    \texit : exit
    ---------------------------------\n
    BASH;
}
