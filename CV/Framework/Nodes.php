<?php

namespace Framework;

use Exception;

class Node
{

    private static $list = [];

    protected $ID;
    private string $parentID;
    private array $childs = [];

    /**
     * 
     * 
     */
    public static function getElementById(string $string)
    {
        return self::$list[$string];
    }

    /**
     * Construct new Node Element
     * 
     * @param string $ID
     */
    function __construct(string $id)
    {
        $this->ID = $id;
        self::$list[$id] = $this;
    }

    /**
     * - $this->id = "myNewId"; (string) 
     *  
     * 
     * @param $string
     * @return mixed
     */
    function __set($string, $value)
    {
        if ("id" == $string) {
            if (is_string($value)) {
                $this->ID = $value;
            } else {
                throw new Exception("Node element require string as id.");
            }
        }
    }

    /**
     * Add a child.
     * 
     * @param self
     * @return void
     */
    function appendChild(self $child): void
    {
        $child->parentID = $this->ID;
        $this->childs[$child->ID] = $child;
    }

    /**
     * If exeist, return parent element, else return null.
     * 
     * @param void
     * @return self|null
     */
    function getParent()
    {
        return self::$list[$this->parentID];
    }

    /**
     * Return array of childrens.
     * 
     * @param void
     * @return array
     */
    function children(): array
    {
        return $this->childs;
    }

    /**
     * If object has child.
     * 
     * @param string $child
     * @param bool $recusive [optional : false]
     * @return bool
     */
    function hasChild(string $childname, bool $recursive = false): bool
    {
        $exist = array_key_exists($childname, $this->childs);
        if (!$exist && $recursive) {
            foreach ($this->children() as $child) {
                $exist = $child->hasChild($childname, $recursive);
            }
        } else {
            return $exist;
        }
    }

    /**
     * Get child.
     * 
     * @param string $childname
     * @param bool $recusive [optional : false]
     * @return bool
     */
    function getChild(string $childname, bool $recursive = false): bool
    {
        $obj = $this->childs[$childname];
        if (null == $obj && $recursive) {
            foreach ($this->children() as $child) {
                $obj = $child->getChild($childname, $recursive);
            }
        } else {
            return $obj;
        }
    }
}
