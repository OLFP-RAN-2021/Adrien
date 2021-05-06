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
    static $Exceptions = [];
    static $phperrors = [];

    /**
     * get thrown;
     */
    static function getTExceptions(\Exception $exception)
    {
        self::$Exceptions[] = $exception;
    }

    /**
     * 
     */
    static function getErrors()
    {
        // get php errors
        while (($error = error_get_last()) != null) {
            self::$phperrors[] = $error;
            error_clear_last();
        }
    }

    /**
     * 
     */
    static function printDebbug()
    {
        // If STDIN
        if (STDIN != null) {
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
    }

    /**
     * 
     */
    static function printConsoleDebbug()
    {
    }
}
