<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 5:34 PM
 */

define('ABSPATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

$tempPath1 = explode('/', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'])));
$tempPath2 = explode('/', substr(ABSPATH, 0, -1));
$tempPath3 = explode('/', str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])));

for ($i = count($tempPath2); $i < count($tempPath1); $i++)
    array_pop ($tempPath3);

$urladdr = $_SERVER['HTTP_HOST'] . implode('/', $tempPath3);

if ($urladdr{strlen($urladdr) - 1}== '/')
    define('URLADDR', 'http://' . $urladdr);
else
    define('URLADDR', 'http://' . $urladdr . '/');

unset($tempPath1, $tempPath2, $tempPath3, $urladdr);

//print_r($_GET);die;

//ini_set("log_errors", 1);
//ini_set("error_log", "logs/errors.log");

spl_autoload_register(function ($class) {
    $file = 'framework/' . str_replace('\\', '/', $class) . '.php';
    if(!file_exists($file)){
        $file = 'application/' . str_replace('\\', '/', $class) . '.php';
    }
    require_once($file);
});

//require 'application/controllers/Controller.php';

$controller = new \controllers\Controller();
$method = 'get_';
if(!empty($_POST))
    $method = 'post_';
$action = isset($_GET['action'])?$_GET['action']:'index';
call_user_func_array(array($controller,$method.$action) ,array());