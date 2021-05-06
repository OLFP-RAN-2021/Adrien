<?php

/**
 * 
 * 
 */
abstract class Listener
{
    /**
     * List of suscribers.
     */
    private $suscribers = [];

    /**
     * 
     * 
     * @return string
     */
    final function addSuscriber(callable $callable): string
    {
        $name = $this->getCallableName($callable);
        $this->suscribers[$name] = $callable;
        return $name;
    }





    /**
     * 
     */
    final function rmSuscriber(callable $callable)
    {

        $DOM = new DOMDocument();
        $DOM->loadHTML('<!DOCTYPE html>');
        $DOM->$name = $this->getCallableName($callable);
        if (strpos($name, 'Closure::', 0) !== false && !array_key_exists($name, $this->suscribers)) {
            throw new LogicException('Do you lost closure name returned by addSuscriber() ??');
        }
        // if (array_key_exists($name, $this->suscribers)) {
        //     unset($this->suscribers[$name]);
        // }
    }

    /**
     * 
     */
    final function sendSuscribers(...$param)
    {
        foreach ($this->suscribers as $callable) {
            call_user_func_array($callable, $param);
        }
    }

    /**
     * Get callable name. If Closure : create a name randomly.
     * 
     * @param callable $callable callable to 
     * @return string
     */
    final function getCallableName(callable $callable): string
    {
        if (is_string($callable)) {
            return $callable;
        } else if (is_array($callable)) {
            if (is_object($callable[0])) {
                return get_class($callable[0]) . '::' . $callable[1];
            } else {
                return $callable[0] . '::' . $callable[1];
            }
        } else if ($callable instanceof \Closure) {
            do {
                $key = 'Closure::' . md5(microtime(true), true);
            } while (array_key_exists($key, $this->suscribers));
            return $key;
        }
    }
}
