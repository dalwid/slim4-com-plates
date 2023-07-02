<?php

namespace app\controllers;

use  League\Plates\Engine;

abstract class Controller
{
    function render(string $view, array $data = [])
    {
        $path = dirname(__FILe__, 2);
        $path;
        $templates = new Engine($path . DIRECTORY_SEPARATOR . 'views');

        // Render a template
        echo $templates->render($view, $data);
    }
}
