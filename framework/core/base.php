<?php
/**
 * Author: Ahmed Maged
 * Date: 4/18/13 - 11:04 AM
 */
namespace core;

class Base{

    public static function get_config_options(){
        $base_path = \Helper::base_path();
        return require_once $base_path.'\application\config\config.php';
    }
}