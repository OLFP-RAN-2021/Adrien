# 


## Customize behaviour

Use abstract RouterCallable Class to extends you own behaviour.

- You MUST `return anonym class`.
- Anonym class class MUST `extends \Framework\Router\RouterCallable`.
- You MUST descrip behaviour in named methods.
- You MUST binding method to url stack with `$this->bind();` in `__construct()`.

To know more [about binding]();

```php

return new class extends \Framework\Router\RouterCallable
{
    function __construct()
    {
        $this->bind(0, 'default', [self::class, 'myMethod1'], []);
        $this->bind(1, 'myMethod_1', [self::class, 'myMethod1'], []);
        // etc..
    }

    /**
     * MyMethod1 wil do...
     * 
     * @param \Framework\Router\Router $Router 
     * @param ...$args arguments for constructor
     * @return object
     */
    function myMethod1($url, ...$args)
    {
        // your code
    }
};

```