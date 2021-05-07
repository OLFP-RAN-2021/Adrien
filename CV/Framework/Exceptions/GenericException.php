<?php

namespace Framework\Exceptions;


class GenericException extends \Exception
{
    private string $description;
    private array $docUrl = [];

    /**
     * 
     */
    function __construct(array $options)
    {
        parent::__construct(
            $options['message'],
            $options['code'],
            $options['throwable']
        );
        $this->levelAlert($options['code']);
        $this->description = $options['description'] ?? null;
        $this->docUrl = $options['refs'];
    }

    /**
     * Make level Alert with code
     * 
     * @param int $code The code.
     * @return void
     */
    function levelAlert(int $code = 0): void
    {
        $this->level = "gray";
        if ($code >= 100)
            $this->level = "info";
        if ($code >= 200)
            $this->level = "success";
        if ($code >= 300)
            $this->level = "warning";
        if ($code >= 400)
            $this->level = "alert";
        if ($code >= 500)
            $this->level = "unicorn";
    }

    /**
     * Format bactrace.
     * 
     * @param void
     * @param string
     */
    function formatBacktrace(): string
    {
        $backtrace = '';
        foreach ($this->getTrace() as $error) {
            if (isset($error['function'])) {
                $backtrace .= 'Called by :';
                if (isset($error['class']))
                    if (strpos($error['class'], 'class@anonymous', 0) !== false) {
                        $backtrace .= 'class@anonymous->';
                    } else {
                        $backtrace .= $error['class'] . ' -> ';
                    }
                $backtrace .= '<b>' . $error['function'] . '()</b> ';
            }
            $backtrace .= 'at line <b>' . $error['line'] . '</b> in <b>' . $error['file'] . '</b><br>';
        }
        return $backtrace;
    }

    /**
     * Formats url lsit.
     * 
     * @param void
     * @return string
     */
    function formatUrls(): string
    {
        $docs = '';
        if (!empty($this->docUrl)) {
            $docs .= '<div class="hidden"><h3> Documentation </h3><ul> ';
            foreach ($this->docUrl as $txt => $url) {
                $docs .= "<li><a href=\"$url\"> $txt</a></li>\n";
            }
            return $docs . ' </ul></div>';
        }
    }

    /**
     * Return object as string.
     * 
     * @param void
     * @return string
     */
    function __toString(): string
    {
        $message = $this->getMessage();
        $error = end($this->getTrace());

        $description = (null != $this->description) ? '<div class="hidden"><h3> Description </h3> 
        ' . $this->description . '</div>' : '';

        $level = $this->level;
        $file = $error['file'];
        $line = $error['line'];

        $docs = $this->formatUrls();
        $backtrace = $this->formatBacktrace();

        // $backtrace = print_r($this->getTrace(), 1);


        $css = RELPATH . '/Framework/Exceptions/style.css';

        /**
         * 
         * Attention, à parir de là, ça pique les yeux... lol
         * 
         */
        return <<<HTML
<link rel="stylesheet" href="$css">
<div class="alert">
    <div class="title $level">
        <h2>Exception : $message</h2>
        <b>$file</b> :: <b>$line</b>
    </div>
    <input id="activator" class="hidden" type="checkbox">
    <label for="activator">Détails</label>
        $description
        $docs
    <div class="hidden">
        <h3>Backtrace </h3>
            $backtrace        
    </div>
</div>
HTML;
    }
}
