<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/19/12
 * Time: 5:52 PM
 */
class Validator
{

    public static function isString($input)
    {
        return preg_match('/^\w*$/',$input);
    }

    public static function isNumeric($input)
    {
        return preg_match('/^\d*$/',$input);
    }

    public static function isMail($input)
    {
        return preg_match('/^\w+@\w+\.\w+$/',$input);
    }
}
