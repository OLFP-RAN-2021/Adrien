<?php

namespace Framework\EventListener;

use Framework\Exception;

class Emitter
{
    /**
     * 
     */
    private self $emitter;

    /**
     * 
     */
    private array $listeners = [];

    /**
     * 
     */
    private ?Listener $lastListenerAdded;

    /**
     * 
     */
    function getEmitter()
    {
        if (null == self::$emitter) {
            self::$emitter = new self;
        }
        return self::$emitter;
    }

    /**
     * 
     */
    function hasListenner(string $event)
    {
        return isset($this->listeners[$event]);
    }

    /**
     * 
     */
    function once(string $event, callable $callable, int $priority = 0)
    {
        $this->bind($event, $callable, $priority, true);
        return $this;
    }

    /**
     * 
     */
    function on(string $event, callable $callable, int $priority = 0)
    {
        $this->bind($event, $callable, $priority, false);
        return $this;
    }

    /**
     * 
     */
    function bind(string $event, callable $callable, int $priority = 0, bool $once = false)
    {
        if (!$this->callableExist($event, $callable)) {
            $this->lastListenerAdded = new Listener($callable, $priority, $once);
            $this->listeners[$event][] = $this->lastListenerAdded;
        } else {
            throw new Exception(['message' => 'Cette callable existe déjà dans le listenner ' . $event . '.']);
        }
        return $this;
    }


    /**
     * 
     */
    function callableExist(string $event, callable $callback)
    {
        if (isset($this->listeners[$event]))
            foreach ($this->listeners[$event] as $listener) {
                if ($callback === $listener->getCallable()) {
                    return false;
                }
            }
        return false;
    }

    /**
     * 
     * 
     */
    function sortListeners($event): void
    {
        uasort($this->listeners[$event], function ($a, $b) {
            if ($a->getPriority() == $b->getPriority())
                return 0;
            return ($a->getPriority() > $b->getPriority()) ? -1 : 1;
        });
    }

    /**
     * Emit a new event.
     * 
     * @param string event.
     * @param ...$args 
     * @return self;
     */
    function emit(string $event, ...$param)
    {
        if ($this->hasListenner($event)) {
            $this->sortListeners($event);
            foreach ($this->listeners[$event] as $callable) {
                if ($callable instanceof Listener) {

                    $callable->call(...$param);
                    if (!$callable->getPropagation()) {
                        break;
                    }
                }
            }
        }
        return $this;
    }

    /**
     * Stop propagation.
     *  
     * @param void
     * @return void
     */
    function stopPropagation(): void
    {
        $this->lastListenerAdded->stopPropagation();
    }
}
