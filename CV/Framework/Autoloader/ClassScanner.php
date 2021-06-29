<?php

namespace Framework\Autoloader;

class ClassScanner
{
    /**
     * Scan file system to get php files.
     * 
     * @param string $folder
     * @return array [classname => filename] 
     */
    function scanRecursive(string $folder): array
    {
        $out = [];
        foreach (glob($folder . '/*') as $file) {
            if (is_dir($file)) {
                $out += $this->scanRecursive($file);
            } else if (strpos($file, '.php', -4)) {
                $out += $this->check($file);
            }
        }
        return $out;
    }

    /**
     * Return [classname => filename] array.
     * 
     * @param string $filename File to parse.
     * @return array [classname => filename]
     */
    function check(string $filename): array
    {
        $content = file_get_contents($filename);

        // /\nnamespace (([\w]+\\?)+);/i
        preg_match('/namespace (([\w]+\\\?)+)/i', $content, $matches);
        $namespace = $matches[1];

        preg_match('/(class|trait|interface) ([\w]+)/i', $content, $matches);
        $classe = $matches[2];

        if (null !== $classe)
            return [$namespace . '\\' . $classe => $filename];
    }
}
