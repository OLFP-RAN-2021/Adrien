<?php
namespace App;

trait SaveAsFile
{
    static $PATH = 'data/';

    /**
     * @return bool
     */
    public static function save(string $filename, object $object): bool
    {
        self::buildPath($filename);
        return file_put_contents($filename, serialize($object));
    }

    /**
     * 
     */
    public static function exists(string $filename)
    {
        self::buildPath($filename);
        return file_exists($filename);
    }

    /**
     * 
     */
    public static function list()
    {
        $filename = get_called_class() . ':*.srz';
        if (strpos($filename, '/') === false)
            $filename = self::$PATH . $filename;
        return glob($filename);
    }

    /**
     * 
     */
    public static function count()
    {
        return count(self::list());
    }

    /**
     * 
     */
    public static function unlink(string $filename)
    {
        self::buildPath($filename);
        unlink($filename);
    }

    /**
     * @return object|void
     */
    public static function load(string $filename)
    {
        self::buildPath($filename);
        if (file_exists($filename))
            return unserialize(file_get_contents($filename));
    }

    /**
     * @return 
     */
    private static function buildPath(string &$filename)
    {
        $filename = get_called_class() . ':' . $filename . '.srz';
        if (strpos($filename, '/') === false)
            $filename = self::$PATH . $filename;
    }
}
