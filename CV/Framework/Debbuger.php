<?php

namespace Framework;

define('DEBBUGER_ERROR', 1);
define('DEBBUGER_WARNING', 2);
define('DEBBUGER_NOTICE', 3);

/**
 * 
 */
class Debbuger
{
    static $singleton;
    private $Exception;
    private $phperrors = [];

    /**
     * Start debbuger
     */
    static function getInstance()
    {
        if (null == self::$singleton) {
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', true);
            self::$singleton = new self();
        }
        return self::$singleton;
    }

    /**
     * Get thrown
     * 
     */
    static function getTException(\Exception $exception)
    {
        self::getInstance()->Exception = $exception;
    }

    /**
     * 
     */
    static function getErrors()
    {
        // get php errors
        while (($error = error_get_last()) != null) {
            self::getInstance()->phperrors[] = $error;
            error_clear_last();
        }
    }

    /**
     * 
     */
    static function printDebbug()
    {

        // If STDIN
        if ('cli' == php_sapi_name()) {
            self::printConsoleDebbug();
        } else {
            self::printHTMLDebbug();
        }
    }

    /**
     * 
     */
    static function printHTMLDebbug()
    {
        echo self::getInstance()->Exception;
    }

    /**
     * 
     */
    static function printConsoleDebbug()
    {
    }
}
