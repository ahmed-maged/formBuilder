<?php
/**
 * Author: Ahmed Maged
 * Date: 4/19/13 - 9:16 AM
 */

class Helper
{
    public static function base_url(){
//        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http";
//        return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return URLADDR;
    }

    public static function base_path(){
//        return realpath('');
        return ABSPATH;
    }

    public static function url($action){
        return static::base_url().$action;
    }
}
