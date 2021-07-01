# Basic event listener



```php

    // random callable
    $callable = function () {
        echo "message 1<br>";
    };

    // Create an Emitter.
    $emitter = new Emitter();

    /**
     * binding on 'event_1', the callable, with index priority.
     */
    
    // this listener would run one time.  
    $emitter->once('event_1', $callable, 2);  

    // Stop propagation will stop stack execution. 
    $emitter->on('event_1', $callable, 3)->stopPropagation();
    
    // don't run cause propagation stopped.
    $emitter->on('event_1', $callable, 1);

    // start emitting  
    $emitter->emit('event_1');


```