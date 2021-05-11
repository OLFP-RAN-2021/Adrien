<?php

namespace Framework\Databases;

use Framework\Exception;
use PDO;
use PDOException;
use PDOStatement;

class QueryHandler
{
    private PDOStatement $statement;
    private PDO $PDO;

    /**
     * Construct 
     */
    function __construct(string $dbname)
    {
        if (($PDO = PDOHandler::getInstance($dbname)) === null) {
            throw new Exception(["message" => "QueryHandler can't get PDO called '$dbname'."]);
        }
        $this->PDO = $PDO;
    }

    /**
     * 
     */
    function prepare(string $request, array $optionsDriver = [])
    {
        $this->statement = $this->PDO->prepare($request, $optionsDriver);
        return $this;
    }

    /**
     *  Chercher à éviter les conflits
     *  UPDATE foo SET (:id = id) WHERE id = id ;
     */
    function bind(array $data): self
    {
        // throw error if 
        if (null === $this->statement) {
            throw new Exception(['message' => "QueryHandler require to prepare statement before binding data."]);
        } else {
            foreach ($data as $key => $value) {
                $this->statement->bindValue($key, $value);
            }
            $this->catchErrors();
        }
        return $this;
    }

    /**
     * catchErrors()
     * 
     * @param void
     * @return void
     * @throw Exception if error dropped by PDO or mysql.
     */
    function catchErrors()
    {
        $error = $this->statement->errorInfo();
        if (!empty($error[0]) && $error[0] != 00000) {
            throw new Exception(['message' => $error[0] . '' . $this->reqest]);
        }
    }

    /**
     * 
     */
    function execute()
    {
        if (null === $this->statement) {
            throw new Exception(['message' => "QueryHandler require to prepare statement before execution."]);
        }
        try {
            $this->statement->execute();
        } catch (PDOException $error) {
            throw new Exception([
                'message' => $error->getMessage(),
                "code" => 303,
                "throwable" => $error
            ]);
        }
        $this->catchErrors();
        return $this;
    }

    /**
     * Fetch.
     * 
     * 
     */
    function fetch(...$fetchMethod)
    {
        if (null === $this->statement) {
            throw new Exception(['message' => "QueryHandler require to execute statement before fetching."]);
        }
        $array = $this->statement->fetchAll(...$fetchMethod);
        $this->catchErrors();
        return $array;
    }
}
