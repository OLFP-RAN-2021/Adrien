<?php

namespace Framework\Databases;

use Framework\Databases\Query;

trait QueryFactoryFacades
{

    /**
     * Select elements.
     * 
     * @param array List of column to load.
     * @return self;
     */
    function select(?string $list = '*'): self
    {
        $this->factory('Select', $list);
        return $this;
    }

    /**
     * Where
     * 
     * @param string key The colmun name.
     * @param string Query::Equal|'=' Logic operator.
     * @param mixed value 
     * @return self 
     */
    function where(...$args)
    {
        return $this->factory('Where', ['', ...$args]);
    }

    /**
     * 
     *  query -> query.cmdfacade -> query.factory -> obj.
     * 
     * 
     * and
     * 
     * @param array Conditions of request.
     * @return self 
     */
    function and(...$args): self
    {
        $this->factory($this->lastCmd, ['AND', ...$args]);
        return $this;
    }

    /**
     * or
     * 
     * @param array Conditions of request.
     * @return self 
     */
    function or(...$args): self
    {
        $this->factory($this->lastCmd, ['OR', ...$args]);
        return $this;
    }

    /**
     * 
     */
    function insert(array $data = []): self
    {
        $this->factory('Insert', $data);
        return $this;
    }

    /**
     * 
     */
    function update(array $data = []): self
    {
        $this->update = $this->factory('Update', $data);
        return $this;
    }

    /**
     * Delete someting.
     * 
     * @param
     * @return
     */
    function delete(array $data = []): self
    {
        $this->factory('Delete', $data);
        return $this;
    }

    /**
     * Alias of delete().
     */
    function truncate(...$args): self
    {
        $this->delete(...$args);
        return $this;
    }

    /**
     * Nesting sub a request.
     * 
     * @param string $key Where key.
     * @param Query $query Sub request.
     * 
     * @return self
     */
    function nest(string $key, Query $query)
    {
        $this->factory('Nest', $key, $query);
        return $this;
    }

    /**
     * 
     */
    function enqueue(Query $query)
    {
        $this->factory('Enqueue', $query);
        return $this;
    }
}
