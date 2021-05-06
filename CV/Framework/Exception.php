<?php

namespace Framework;

class Exception extends \Exception
{


    private array $docUrl = [];

    function __construct(string $description, array $docs, ...$parent)
    {
        $this->description = $description;
        $this->docUrl = $docs;
        parent::__construct(...$parent);
    }



    function __toString()
    {
        $message = $this->getMessage();
        $description = $this->description;
        $error = end($this->getTrace());

        $file = $error['file'];
        $line = $error['line'];

        $backtrace = print_r($this->getTrace(), 1);

        $docs = '';
        foreach ($this->docUrl as $txt => $url) {
            $docs .= "<lil><a href=\"$url\"> $txt</a></li>\n";
        }

        /**
         * 
         * Attention, à parir de là, ça fait mal aux yeux... lol
         * 
         */
        return <<<HTML
<style>
    .alert, .alert div, .alert label  {
        padding:1em;
    }
    .alert .title {
        border:1px solid black;
        background-color:darkorange;
        padding:1em;
    }
    .alert label{
        border:1px solid black;
        display:block;
        background-color:white;
    }
    #activator:checked ~ div {
        display:block;
    }
    .hidden{
        display:none;
    }

</style>
<div class="alert">
    <div class="title">
        <h2>Exception : $message</h2>
        <b>$file</b> :: <b>$line</b>
    </div>
    <label for="activator">Détails</label>
    <input id="activator" class="hidden" type="checkbox">
    <div class="hidden">
        $description
    </div>
    <div class="hidden">
        Documentation :<br>
        <ul> 
            $docs
        </ul>
    </div>
    <div class="hidden">
        <pre>
            $backtrace        
        </pre>
    </div>
</div>
HTML;
    }
}
