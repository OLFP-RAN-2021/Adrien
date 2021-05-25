<?php

namespace Framework\Databases;

use Framework\Exception;

trait QueryFetcher
{
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
            if (!$All) {
                foreach ($this->statement->fetch(...$fetchMethod) as $key => $row) {
                    call_user_func_array($callable, [$key, $row]);
                }
            } else {
                foreach ($this->statement->fetchAll(...$fetchMethod) as $key => $row) {
                    call_user_func_array($callable, [$key, $row]);
                }
            }
        } else {
            if (!$All) {
                $array = $this->statement->fetch(...$fetchMethod);
            } else {
                $array = $this->statement->fetchAll(...$fetchMethod);
            }
            $this->catchErrors();
            $this->statement->closeCursor();
            return $array;
        }
        $this->catchErrors();
        $this->statement->closeCursor();
    }
}
