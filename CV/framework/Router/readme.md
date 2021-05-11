# 

## How its work ? 

- Url is splited and will browsed in url loop.
    - Each one would be binded to a callstack level.
    - **IF** callable return null, other of level will be tested to end of stack.
        - else stack is closed and url loop continue.
    - **IF** level is closed without hinertience : url loop is closed too.
        - else url loop continue.

### Logic model :
```
    url -> rewind()

    Route ( url )
        hineritence = null

        BROWSE stack[ key ] AS callable        
            hineritence = callable ( url, hineritence, ...args )

            IF hineritence == null 
                CONTINUE
            ELSE
                BREAK
        
        IF hineritence != null
            url -> next 
            Route ( url )

```

## Customize behavior

Use abstract RouterCallable Class to extends you own behavior.

- You MUST `return anonym class`.
- Anonym class class MUST `extends \Framework\Router\RouterCallable`.
- You MUST descrip behavior in named methods.
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