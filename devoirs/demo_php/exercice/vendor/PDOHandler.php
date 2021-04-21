<?php
namespace App;

use PDO;
use PDOException;

class PDOHandler {

    static $PDO;

    /**
     * 
     */
    function __construct()
    {
        self::init('', '', '', '', '');
    }

    /**
     * Init PDO
     */
    static function init($hostname, $dbname, $login, $passwd, $dbtype = "mysql", $charset = null){
        if (self::$PDO == null){
            $dsn = $dbtype.';host='.$hostname.';dbname='.$dbname.';';
            $opts = '';
            try{
                self::$PDO = new PDO($dsn, $login, $passwd, $opts);
            }
            catch(PDOException $e){
                // gérer l'erreur de connexion PDO
            }

        }
    }

    /**
     * 
     */
    static function bind(\PDOStatement $stmnt, array $array)
    {

    }

    /**
     * 
     */
    static function fetch(\PDOStatement $stmnt, $methode = null){
        
    }


}