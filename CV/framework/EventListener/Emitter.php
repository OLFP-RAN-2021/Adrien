<?php

namespace Framework\EventListenner;

abstract class Emitter
{
    /**
     * 
     */
    private self $emitter;

    /**
     * 
     */
    private array $listenners = [];

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
        return isset($this->listenners[$event]);
    }

    /**
     * 
     */
    function on(string $event, callable $callable)
    {
        $this->listenners[$event][] = $callable;
    }

    /**
     * 
     */
    function emit(string $event, ...$param)
    {
        if ($this->hasListenner($event))
            foreach ($this->listenners[$event] as $callable)
                yield $callable(...$param);
    }
}
