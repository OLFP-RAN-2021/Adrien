<?php

namespace Framework\Autoloader;

class FileBrowser
{
    function __construct(
        string $folder
    ) {
        $s = DIRECTORY_SEPARATOR;
        $folder = str_replace(['\\', '/'], $s, $folder);
        if (file_exists($folder . $s . 'src')) {
            $folder = $folder . $s . 'src';
        }
        $this->folder = $folder;
    }

    /**
     * 
     */
    function search($class)
    {
        $s = DIRECTORY_SEPARATOR;
        $namespaceRoot =  explode('\\', $class)[0];

        $replace = ['\\', $namespaceRoot . $s];
        $with = [$s, ''];
        $classpath = str_replace($replace, $with, $class);

        $path = $this->folder . $s . $classpath . '.php';

        if (file_exists($path)) {
            include_once $path;
            return true;
        } else {
            return $this->recursive($folder, $class);
        }
    }

    /**
     * Parcourir les fichiers récursivement.
     * 
     * @param string $folder
     * @param string $class
     * @return 
     */
    function recursive(string $folder, string $class)
    {
        $s = DIRECTORY_SEPARATOR;
        $array = explode('\\', $class);
        $classname = end($array);
        foreach (glob($folder . $s . '*') as $file) {
            if (is_dir($file)) {
                $this->recursive($file, $class);
            }
            if (is_file($file) && basename($file) == $classname . '.php') {
                if (include_once $file) {
                    return true;
                }
            }
        }
        return false;
    }
}
