<?php
/**
 * Author: Ahmed Maged
 * Date: 4/19/13 - 4:53 PM
 */
class SystemHelper
{
    public static function remove_namespace($string){
        $new_string = explode('\\',$string);
        return end($new_string);
    }
}
