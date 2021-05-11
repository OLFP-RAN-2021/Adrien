<?php

namespace Framework\Databases;

use Framework\Exception;
use PDO;
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
        $this->request = $request;
        $this->statement = $this->PDO->prepare($request, $optionsDriver);
        return $this;
    }

    /**
     * 
     *  Chercher à éviter les conflits
     *  UPDATE foo SET (:id = id) WHERE id = id ;
     * 
     */
    function bind(array $data): self
    {
        // throw error if 
        if (null === $this->statement) {
            throw new Exception(['message' => "QueryHandler require to prepare statement before binding data."]);
        } else {
            $this->dataKeys = [];
            foreach ($data as $key => $value) {
                $okey = $key;
                while (in_array($key, $this->dataKeys)) {
                    $key = '_' . $key;
                }
                $this->dataKeys[] = $key;

                $this->request = str_replace($okey, $key, $this->request);
                $this->statement->bindValue($key, $value);
            }

            if (!empty($this->statement->errorInfo())) {
                throw new Exception(['message' => $this->statement->errorInfo()]);
            }
        }

        return $this;
    }

    /**
     * 
     */
    function execute(array $data)
    {
        if (null === $this->statement) {
            throw new Exception(['message' => "QueryHandler require to prepare statement before execution."]);
        }
        $this->statement->execute();
    }

    /**
     * 
     */
    function fetch(...$fetchMethod)
    {
        return $this->statement->fetchAll(...$fetchMethod);
    }
}
