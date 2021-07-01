<?php

namespace Framework\Autoloader;

include_once __DIR__ . '/Autoloader.php';

/**
 * 
 */
class Handler
{

    const PATH = __DIR__.'/cache/handler.php';
    static ?self $handler = null;

    /**
     * 
     */
    function __construct()
    {
        if (file_exists(self::PATH))
            foreach (include self::PATH as $key => $value)
                $this->$key = $value;
    }

    /**
     * build 
     */
    static function getInstance(...$args)
    {
        if (null === self::$handler)
            self::$handler =  new self(...$args);
        return self::$handler;
    }

    /**
     * 
     */
    static function auto(string $id, array $namespaces = [])
    {
        $handler = self::getInstance();
        $handler->create($id, $namespaces, true);
    }

    /**
     * Create new autoloader
     */
    function create(string $id = 'default', array $namespaces = [], bool $registre = true)
    {
        $name = 'autoloader_' . $id . '_' . time();
        $autoloader = new Autoloader($name);
        $autoloader->loadConfig($namespaces);

        if ($registre) $autoloader->register();
        $autoloader->scanner();
        $this->list[$name] = $autoloader;
        $this->current = $name;
    }

    /**
     * 
     */
    function update(string $name = null)
    {
        // if (!empty($name) && isset(self::$list[$name])) {
        //     $autoloader = self::$list[$name];
        //     $autoloader->cleanCache();
        // }
    }

    /**
     * 
     */
    function delete(string $name = null)
    {
    }

    /**
     * Save data.
     */
    function save()
    {
        $data = format(get_object_vars($this));
        file_put_contents(self::PATH, $data);
    }
}
