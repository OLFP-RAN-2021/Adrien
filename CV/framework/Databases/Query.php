<?php

namespace Framework\Databases;

use Framework\Exception;
use PDO;
use PDOException;
use PDOStatement;
use QueryCMD;
use QueryJoin;
use ReflectionClass;

class Query
{

    // use QueryCmd;
    // use QueryJoin;

    private ?PDOStatement $statement = null;
    private ?PDO $PDO = null;

    /**
     * Construct 
     */
    function __construct(?string $dbname, ?string $tablename = null)
    {
        if (($PDO = PDOHandler::getInstance($dbname)) === null) {
            throw new Exception(["message" => "QueryHandler can't get PDO called '$dbname'."]);
        }
        $this->PDO = $PDO;
        $this->dbname =  $dbname;
        $this->tablename = $tablename;
    }

    /**
     * Use to taget dbname.tablename or only tablename
     * 
     * 
     */
    static function on(string $dbname)
    {
        if (strpos($dbname, '.')) {
            $parts = explode('.', $dbname);
            $dbname = $parts[0];
            $tablename = $parts[1];
        } else {
            $dbname = null;
            $tablename = $dbname;
        }
        return new self($dbname, $tablename);
    }

    /**
     * 
     */
    function caller(string $name, $args)
    {
        $classname = '\Framework\Databases\cmd\\' . strtolower($name);
        if (class_exists($classname, true)) {
            var_dump('ok');
            $reflection = new ReflectionClass($classname);
            if ($reflection->isInstantiable()) {
                $cmdObj = $reflection->newInstanceArgs($args);
                // append request
                $this->appendRequest((string) $cmdObj);
                // var_dump((string) $cmdObj);
                // append data
                $this->appendData((array) $cmdObj->args);
                // var_dump((array) $cmdObj->args);
            }
        }
    }


    function select(array $list = [])
    {
        $this->caller('Select', $list);
        return $this;
    }


    /**
     * Add request string.
     * 
     * @param array Data to push in request.
     * @return self
     */
    function appendRequest(string $request = '')
    {
        $this->request .= $request;
        // return $this;
    }

    /**
     * Add append data.
     */
    function appendData(array $data = [])
    {
        $this->data = array_merge($this->data, $data);
    }












    /**
     * Enqueue a query.
     * 
     * @param self Query to push in sub.
     * @return self
     */
    // function enqueue(self $query): self
    // {
    //     foreach ($query->data as $ckey => $value) {
    //         $nkey = $ckey;
    //         while (isset($this->data[$nkey])) {
    //             $nkey .= "_";
    //         }
    //         $this->data[$nkey] = $value;
    //         $query->request = str_replace(':' . $ckey, ':' . $nkey, $query->request);
    //     }
    //     $this->request .= $query->request;
    //     return $this;
    // }

    /**
     * Add nested request.
     * 
     * @param string Key where to push.
     * @param self Query to push in sub.
     * @return self
     */
    function nest(string $key, self $query): self
    {
        if (isset($query->data)) {
            foreach ($query->data as $ckey => $value) {
                $nkey = $ckey;
                while (isset($this->data[$nkey])) {
                    $nkey .= "_";
                }
                $this->data[$nkey] = $value;
                $query->request = str_replace(':' . $ckey, ':' . $nkey, $query->request);
            }
            $this->request = str_replace(':' . $key, '( ' . $query->request . ' )', $this->request);
        }

        return $this;
    }


    /**
     *  Importer les données.
     * 
     * @param array Data to push in request.
     * @return self
     */
    function setData(array $data): self
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        $this->catchErrors();
        return $this;
    }

    /**
     *  Importer les données.
     * 
     * @param array Data to push in request.
     * @return array
     */
    function getData(): array
    {
        return $this->data;
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
     * Get a PDOStatement.
     * 
     * @param array List of options for PDO Driver.
     * @return self 
     */
    function getStatement(array $optionsDriver = [])
    {
        $this->statement = $this->PDO->prepare($this->request, $optionsDriver);
        if (isset($this->data)) {
            foreach ($this->data as $key => $value) {
                $this->statement->bindValue($key, $value);
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
                case '42S02':
                    $code = 400;
                    break;
                case '00000':
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
