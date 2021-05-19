<?php

namespace Framework\Databases;

use Framework\Exception;
use PDO;
use PDOException;
use PDOStatement;

class Query
{

    use QueryFactoryFacades;
    use QueryFactory;
    // use QueryJoin;

    public ?PDOStatement $statement = null;
    public ?PDO $PDO = null;

    public ?string $dbname = null;
    public ?string $tablename = null;

    // public array $stack = [];

    public string $request = '';
    public array $data = [];

    const Equal = '=';
    const Not = '!=';
    const Highter = '>';
    const HighterOrEqual = '>=';
    const Lower = '<';
    const LowerOrEqual = '<=';

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

    /**
     * Fetch data.
     * 
     * @param null|string Callable to execute.
     * @param mixed Args for fetch.
     * @return null|mixed
     */
    private function fetcher(bool $All = false, ?callable $callable = null,  ...$fetchMethod)
    {
        $fetchMethod = (!empty($fetchMethod)) ?  $fetchMethod : [\PDO::FETCH_ASSOC];

        if (null === $this->statement) {
            throw new Exception(['message' => "QueryHandler require to execute statement before fetching."]);
        }

        if (null !== $callable) {
            if (!$All)
                foreach ($this->statement->fetch(...$fetchMethod) as $key => $row)
                    call_user_func_array($callable, [$key, $row]);
            else
                foreach ($this->statement->fetchAll(...$fetchMethod) as $key => $row)
                    call_user_func_array($callable, [$key, $row]);
        } else {
            if (!$All)
                $array = $this->statement->fetch(...$fetchMethod);
            else
                $array = $this->statement->fetchAll(...$fetchMethod);
            $this->catchErrors();
            $this->statement->closeCursor();
            return $array;
        }
        $this->catchErrors();
        $this->statement->closeCursor();
    }

    /**
     * 
     */
    function fetchClass(string $class)
    {
    }

    /**
     * 
     */
    function fetchObj(object $obj)
    {
    }

    /**
     * 
     */
    function fetch(...$fetchMethod)
    {
        return $this->fetcher(false, null,  ...$fetchMethod);
    }

    /**
     * 
     */
    function fetchAll(...$fetchMethod)
    {
        return $this->fetcher(true, null,  ...$fetchMethod);
    }

    /**
     * 
     */
    function fetchCall(callable $callback, ...$fetchMethod)
    {
        return $this->fetcher(false, $callback,  ...$fetchMethod);
    }

    /**
     * 
     */
    function fetchAllCall(callable $callback, ...$fetchMethod)
    {
        return $this->fetcher(true, $callback,  ...$fetchMethod);
    }
}
