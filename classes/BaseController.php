<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 9:59 PM
 */
class BaseController
{

    public function render($filename)
    {
        require_once 'views/'.$filename;
        die;
    }
}
