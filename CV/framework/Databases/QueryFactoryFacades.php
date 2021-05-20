<?php

namespace Framework\Databases;

use Framework\Databases\Query;

trait QueryFactoryFacades
{

    /**
     * Select element.
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
     * From element.
     * 
     * @param array List of column to load.
     * @return self;
     */
    function from(?string $list = '*'): self
    {
        $this->factory('From', $list);
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
        return $this->factory('Where', 'AND', ...$args);
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
        $this->factory('Where', 'AND', ...$args);
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
        $this->factory('Where', 'OR', ...$args);
        return $this;
    }

    /**
     * 
     */
    function insert(string $tablename = null, array $data = []): self
    {
        $this->factory('Insert', $tablename, $data);
        return $this;
    }

    /**
     * 
     */
    function update(string $tablename = '', array $data = []): self
    {
        $this->factory('Update', $tablename, $data);
        return $this;
    }

    /**
     * Delete someting.
     * 
     * @param string $tablename
     * @return
     */
    function delete(string $tablename = null): self
    {
        $this->factory('Delete', $tablename);
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
    function join(...$args)
    {
        $this->factory('Join', ...$args);
        return $this;
    }
}
