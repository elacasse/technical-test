<?php

namespace Views;

abstract class BaseView
{
    abstract public function render();

    /**
     * @param $file
     * @param $args
     * @return false|string
     */
    protected function loadTemplate($file, $args)
    {
        // Ensure the file exists
        if (!file_exists($file)) {
            return '';
        }

        // Make values in the associative array easier to access by extracting them
        if (is_array($args)) {
            extract($args);
        }

        // Buffer the output (including the file is "output")
        ob_start();
        /** @noinspection PhpIncludeInspection */
        include $file;

        return ob_get_clean();
    }
}