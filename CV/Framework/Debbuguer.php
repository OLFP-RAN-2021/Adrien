<?php

define('DEBBUGER_ERROR', 1);
define('DEBBUGER_WARNING', 2);
define('DEBBUGER_NOTICE', 3);

/**
 * 
 */
class Debbuguer
{
    static $list = [];
    static $phperrors = [];

    /**
     * get thrown;
     */
    static function getTthrown($exception)
    {
        $backtrace = debug_backtrace();
    }

    static function getTPDOException(PDOException $exception)
    {
        $backtrace = debug_backtrace();
    }

    static function getTException(Exception $exception)
    {
        $backtrace = debug_backtrace();
    }

    /**
     * 
     */
    static function printDebbug()
    {
        // get php errors
        while (($error = error_get_last()) != null) {
            self::$phperrors[] = $error;
            error_clear_last();
        }

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
