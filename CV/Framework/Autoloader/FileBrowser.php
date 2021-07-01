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
     * Search file.
     * 
     * @param string $class
     */
    function search($class): null|string
    {
        $s = DIRECTORY_SEPARATOR;
        $this->vendorName =  explode('\\', $class)[0];

        $replace = ['\\', $this->vendorName . $s];
        $with = [$s, ''];
        $classpath = str_replace($replace, $with, $class);

        $path = $this->folder . $s . $classpath . '.php';

        if (file_exists($path)) {
            return $path;
        } else {
            return $this->recursive($this->folder, $class);
        }
    }

    /**
     * Browse files recursivly.
     * 
     * @param string $folder
     * @param string $class
     * @return null|string
     */
    function recursive(string $folder, string $class): null|string
    {
        $s = DIRECTORY_SEPARATOR;
        $array = explode('\\', $class);
        $classname = end($array);

        foreach (glob($folder . $s . '*') as $file) {
            if (is_dir($file)) {
                $this->recursive($file, $class);
            }
            if (is_file($file) && basename($file) == $classname . '.php') {
                return $file;
            }
        }
    }
}
