<?php

namespace Framework\Databases\SQLElements;

use Traversable;

class TableFieldset implements Traversable
{
    /**
     * field list
     */
    private $data = [];

    /**
     * 
     * @param array : list of fields.
     */
    function construct(?array $fieldset = [])
    {
        if ($fieldset) {
            foreach ($fieldset as $field) {
                if ($field instanceof Field) {
                    $this->set($field);
                }
            }
        }
    }

    /**
     *
     *  @param Field : A field.
     */
    function set(Field $field)
    {
        $this->data[$field->name] = $field;
    }

    /**
     * 
     */
    function get(string|Field $name)
    {
        $name = (is_object($name)) ? $name->name : $name;
        if (isset($this->$name)) {
            return $this->data[$name];
        } else {
            return null;
        }
    }


    /**
     * 
     */
    function isset(string|Field $name)
    {
        $name = (is_object($name)) ? $name->name : $name;
        return isset($this->data[$name]);
    }

    /**
     * 
     */
    function unset(string|Field $name)
    {
        $name = (is_object($name)) ? $name->name : $name;
        unset($this->data[$name]);
    }

    // function 
}
