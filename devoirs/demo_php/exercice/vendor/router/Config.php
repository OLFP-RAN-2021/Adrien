<?php
return [
    [
        'lvl' => 0,
        'call' => function ($urls = []) {
            if (class_exists('App\controllers\Page', true)) {
                $page = new App\controllers\Page();
                var_dump($page);
            }
        }
    ],
    [
        'lvl' => 1,
        'call' => function ($urls = [], $pathElem, $herited) {
            
            
            // is html file
            if (stripos('.html', $pathElem, -5) === false){
                if (class_exists('App\controllers\Page', true)) {
                    $page = new App\controllers\Page($pathElem);
                }
            }

            // is App classname
            elseif (class_exists('App\controllers\\'.$pathElem, true)){
                $class = 'App\controllers\\'.$pathElem;
                return new $class();
            }

            // 
            else {
                http_response_code(404);
                echo '404 Not found';
                exit;
            }
        }

    ],
    [
        'lvl' => 2,
        'call' => function ($urls = [], $pathElem, $herited) {
            if (
                isset($herited) && is_object($herited) && method_exists($herited, $pathElem)
            ) {
                return $this->CalledObj->$pathElem($urls);
            }
        }

    ]

];
