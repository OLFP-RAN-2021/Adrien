<?php

namespace Framework\Databases;

use Framework\Exception;
use PDO;
use PDOException;
use PDOStatement;

class PDOHandler
{
    /**
     * @static array $PDO : Store array of PDO connections.
     */
    static $PDO;

    /**
     *
     * @param string $tag DB identifier for this handler.
     * @param string $dbname The name of database.
     * @param string $dbhost Address of server.
     * @param string $login Login to database.
     * @param string $passwd Password to login.
     * @param string $dbtype [optional] Type db (mysql)
     * @param string $charset [optional]  Charset (utf8mb4-general-ci)
     * @param string $collation [optional] Collation (utf8mb4-general-ci) 
     */
    private function __construct(
        string $tag,
        string $dbname,
        string $dbhost,
        string $login,
        string $passwd,
        string $dbtype = "mysql",
        string $charset = 'utf8mb4-general-ci',
        string $collation = 'utf8mb4-general-ci'
    ) {
        try {
            $dsn = $dbtype . ':dbname=' . $dbname . ';hostname=' . $dbhost . ';';
            self::$PDO[$tag] =  new PDO($dsn, $login, $passwd);
        } catch (PDOException $e) {
            throw new Exception(["message" => $e, "code" => 300]);
        }
    }

    /**
     * Get PDO Instance.
     * 
     * @param ...$args see __construct() above;
     * @return self
     */
    static function getInstance(...$params)
    {
        if (!isset(self::$PDO[$params[0]])) {
            if (count($params) >= 5) {
                new self(...$params);
            } else {
                throw new Exception([
                    "message" => "getInstance() require __construct() args.",
                    "code" => 400
                ]);
            }
        }
        return self::$PDO[$params[0]];
    }
}
