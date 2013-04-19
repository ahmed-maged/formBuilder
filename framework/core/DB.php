<?php
/**
 * Author: Ahmed Maged
 * Date: 4/18/13 - 3:51 PM
 */

namespace core;

class DB
{

    public static function get_db(){
        $config = Base::get_config_options();
        $db_name = $config['db_name'];
        if($config['db_type'] === 'mongo'){
            $m = new \MongoClient();
            $db = $m->$db_name;
            return $db;
        }
        return false;
    }
}
