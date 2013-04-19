<?php

/**
 * Base Controller class containing common functionalities for all controllers to extend
 */

namespace core;
class BaseController
{

    public function render($filename,array $vars = null)
    {
        $baseDir = \Helper::base_path();
        if(isset($vars))
            extract($vars);
        ob_start();
        require_once $baseDir.'/application/views/'.$filename;
        $content = ob_get_contents();
        ob_end_clean();
        require_once $baseDir.'/application/templates/'.'main.php';
    }
}
