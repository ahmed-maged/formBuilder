<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 10:15 PM
 */

namespace core;

class BaseModel
{
    public $db;

    public function __construct(){
        $this->db = \db\DB::get_db();
    }

    /**
     * @return bool success
     */
    public function validate()
    {
        $this->messages = array();

        return true;
    }




//    public static function delete(array $filter)
//    {
//
//        $tableName = get_called_class();
//
//        $db = DB::get_db();
//
//        $collection = $db->$tableName;
//
//        $collection->remove($filter);
//
//    }
}
