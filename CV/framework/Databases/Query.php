<?php

namespace Framework\Databases;

use Framework\Exception;
use PDO;
use PDOException;
use PDOStatement;

class Query
{
    // call traits describing fluents
    use QueryFactoryFacades, QueryFactory;

    // call traits describing fetch 
    use QueryFetcherFacades, QueryFetcher;

    // PDO handling
    public ?PDOStatement $statement = null;
    public ?PDO $PDO = null;

    public ?string $dbname = null;
    public ?string $tablename = null;

    // public array $stack = [];

    public string $request = '';
    public array $data = [];

    /**
     * Construct 
     */
    function __construct(?string $dbname)
    {
        if (($PDO = PDOHandler::getInstance($dbname)) === null) {
            throw new Exception(["message" => "QueryHandler can't get PDO called '$dbname'."]);
        }
        $this->PDO = $PDO;
        $this->dbname =  $dbname;
    }

    /**
     * Use to taget dbname.tablename or only tablename
     * 
     * 
     */
    static function on(?string $dbname = null)
    {
        return new self($dbname);
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
        if (null != $this->statement) {
            $error = $this->statement->errorInfo();
            if (!empty($error[0]) && $error[0] != 00000) {
                throw new Exception(['message' => $error[0] . '' . $this->reqest]);
            }
        }
    }

    /**
     * Dump request state.
     * 
     */
    function dump()
    {
        foreach ($this->stack as $stack) {
            echo "<pre><b>" . get_class($stack) . "</b><br>";
            echo "" . ($stack->request ?? '') . "<br>";
            echo "" . print_r($stack->data, 1) . "</pre><br>";
        }
        return $this;
    }

    /**
     * Get a PDOStatement.
     * 
     * @param array List of options for PDO Driver.
     * @return self 
     */
    function getStatement(array $optionsDriver = [])
    {
        $this->runStack();

        $this->statement = $this->PDO->prepare($this->request . ';', $optionsDriver);
        if (isset($this->data)) {
            foreach ($this->data as $key => $value) {
                if (!$this->statement->bindValue($key, $value)) {
                    // var_dump('error');
                }
            }
            $this->catchErrors();
        }
        return $this;
    }

    /**
     *  Try to execute PDO. Can build ea default statemenent if dont exist. 
     * 
     * @param void
     * @return self 
     */
    function execute()
    {
        if (null === $this->statement) {
            $this->getStatement([]);
        }
        try {
            $this->statement->execute();
        } catch (PDOException $error) {
            switch ($error->getCode()) {
                case '42000':   // empty request
                    $code = 300;
                    break;
                case '42S02':   // sql string format error
                    $code = 400;
                    break;
                case '00000':   // nothing
                    $code = 200;
                    break;
                default:
                    $code = 100;
                    break;
            }
            $data = ($this->data ?? []);
            throw new Exception([
                'message' => $error->getMessage() . '<br>',
                'description' => '<br><b>Request : </b>' . $this->request
                    . '<br><br><b>Data : </b><br>' . print_r($data, 1),
                "code" => $code,
                "throwable" => $error
            ]);
        }
        $this->catchErrors();
        return $this;
    }
}
