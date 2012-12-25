<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 9:59 PM
 */
class BaseController
{

    public $baseUrl='http://localhost/projects/hollycode2';

    public function render($filename)
    {
        ob_start();
        require_once 'views/'.$filename;
        $content = ob_get_contents();
        ob_end_clean();
        require_once 'templates/main.php';
        die;
    }
}
