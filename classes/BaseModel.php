<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 10:15 PM
 */
class BaseModel
{

//    public static $tableName;
    public $props = array();

    public static function set_name($name)
    {
        self::$tableName = $name;
    }
    public function __set($_prop , $val)
    {
        $this->props[$_prop] = $val;
    }

    public function save()
    {
        if(!$this->validate())
            return false;

        $DBH = Db::getDBH();
        $STH = $DBH->prepare("
        INSERT INTO ".$this->tableName." ".implode(',',$this->props)."
                value " . preg_replace('/(\w+)/',':$1',implode(',',$this->props)));
        if(!$STH->execute($this->props))
        {
            return false;
        }
    }

    public static function all()
    {
//        echo 'SELECT * from '.(new static)->tableName;die;
        $result = array();
        $DBH = Db::getDBH();
        $STH = $DBH->query('SELECT * from '.(new static)->tableName);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return $result;
    }
}
