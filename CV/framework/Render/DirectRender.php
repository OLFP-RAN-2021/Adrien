<?php

namespace Framework\Render;

use LogicException;

class DirectRender
{
    /**
     * @var static $singleton.
     */
    static $singleton;

    /**
     * @var string $directory Directory to use.
     */
    private $directory;

    /**
     * @var array 
     */


    /**
     * @var array $cssFiles List of CSS files;
     */
    private array $cssFiles = [];

    /**
     * @var array $jsMuduleFiles List of JS Modules files;
     */
    private array $jsMuduleFiles = [];

    /**
     * Get a singleton.
     * 
     * @param string $directory
     */
    private function __construct(?string $directory)
    {
        $this->directory = $directory ?? 'App/includes/views';
    }

    /**
     * Set/get singleton.
     * 
     * @param spread : see __construct()
     * @return self
     */
    static function getInstance(...$args): self
    {
        if (null === self::$singleton)
            self::$singleton = new self(...$args);
        return self::$singleton;
    }

    /**
     * Bind a param.
     * 
     * @param string $key
     * @param string $value
     * @return void
     */
    static function bindParam(string $key, string $value)
    {
        self::getInstance()->$key = $value;
    }

    /**
     * Make render.
     * 
     * @param void
     * @return void
     */
    function render(bool $string = false)
    {
        if (file_exists($this->directory . '/index.php')) {
            if (true === $string) {
                return include_once $this->directory . '/index.php';
            } else {
                include_once $this->directory . '/index.php';
            }
        } else {
            throw new LogicException("Render need file to build render at '$this->directory/index.php'.");
        }
    }
}
