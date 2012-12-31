<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 5:34 PM
 */


//print_r($_GET);die;

//ini_set("log_errors", 1);
//ini_set("error_log", "logs/errors.log");

spl_autoload_register(function ($class) {
    @include 'classes/' . $class . '.php';
});

require 'controllers/Controller.php';
$controller = new Controller();
$method = 'get_';
if(!empty($_POST))
    $method = 'post_';
call_user_func_array(array($controller,$method.$_GET['action']) ,array());