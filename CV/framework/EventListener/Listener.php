<?php

namespace Framework\EventListener;

use Framework\Exception;

/**
 * Listener will built by Emitter class.
 * 
 */
class Listener
{
    /**
     * @var callable 
     */
    private $callable;

    /**
     * @var int Priority index. 
     */
    public int $priority = 0;

    /**
     * @var int Nbr of called.
     */
    private int $called = 0;

    /**
     * @var bool Execute once.
     */
    private bool $once = false;

    /**
     * @var bool Strop propagation.
     */
    private bool $propagation = true;

    /**
     * 
     * @param callable
     * @param int $priority
     * @param bool $once
     * @return void 
     */
    function __construct($callable, $priority, $once)
    {
        $this->callable = $callable;
        $this->priority = $priority;
        $this->once = $once;
    }

    /**
     * Call the callable.
     * 
     * @param ...$args  
     * @return self
     */
    function call(...$args): self
    {
        if (!$this->once || 0 == $this->called) {
            call_user_func_array($this->callable, $args);
            ++$this->called;
        } else {
            throw new Exception([
                "message" => "This listener must called once.",
                "code" => 301
            ]);
        }
        return $this;
    }

    /**
     * Return callable.
     * 
     * @param void
     * @return callable
     */
    function getCallable(): callable
    {
        return $this->callable;
    }

    /**
     * Return priority.
     * 
     * @param void
     * @return int
     */
    function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Return propagation bool.
     * 
     * @param void
     * @return bool
     */
    function getPropagation(): bool
    {
        return $this->propagation;
    }

    /**
     * Stop propagation.
     *  
     * @param void
     * @return void
     */
    function stopPropagation(): void
    {
        $this->propagation = false;
    }
}
