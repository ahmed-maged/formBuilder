<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 10:15 PM
 */
class BaseModel
{

    public static $tableName;
    public $props = array();
    public $messages = array();
    public static $relations = array();


    public function __set($_prop , $val)
    {
        $this->props[$_prop] = $val;
    }

    public function __get($prop)
    {
        if(!isset($this->$prop))
        {
            if(isset($this->props[$prop]))
                return $this->props[$prop];
        }
    }

    public function __call($method,$args)
    {
//        print_r(array('conditions'=>array(' '.static::$relations[$method]['fk'].' = '.$this->id)));die;
        if(!empty(static::$relations))
        {
            $relations = array_keys(static::$relations);
            if(in_array($method,$relations))
            {
                $class = ucfirst(static::$relations[$method]['model']);
                return $class::findByConditions(array('conditions'=>array(' '.static::$relations[$method]['fk'].' = '.$this->id)));
            }
        }
    }

    /**
     * @return bool success
     */
    public function validate()
    {
        $this->messages = array();

        return true;
    }


    public function save()
    {
        if(!$this->validate())
            return false;

        $DBH = HollyDb::getDBH();
        $STH = $DBH->prepare("
        INSERT INTO ".static::$tableName." (".implode(',',array_keys($this->props)).")
                VALUES (" . preg_replace('/(\w+)/',':$1',implode(',',array_keys($this->props))).")");
        if(!$STH->execute($this->props))
        {
//            echo 'statement:'."
//        INSERT INTO ".static::$tableName." (".implode(',',array_keys($this->props)).")
//                VALUES (" . preg_replace('/(\w+)/',':$1',implode(',',array_keys($this->props))).")<br>";
//            print_r($STH->errorInfo());
//            die('did not insert');
            return false;
        }
        $this->id = $DBH->lastInsertId();
//        echo $this->id.":::";
        return true;
    }

    public static function all()
    {
        $result = array();
        $DBH = HollyDb::getDBH();
        $STH = $DBH->query('SELECT * from '.static::$tableName);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return $result;
    }

    public static function find($id)
    {
        $DBH = HollyDb::getDBH();
        $STH = $DBH->query('SELECT * from '.static::$tableName .' WHERE id='.(int)$id);
        $STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
        $obj = $STH->fetch();
        return $obj;
    }

    /**
     * Get rows by conditions
     * $params should be an array in the form of:
     * array(
     *  'conditions'=>
     *        array(
     *             'condition1',
     *             'condition2'
     *              ),
     *  'options'=>   //optional
     *       array(
     *             'orderby'=>'',
     *             'limit'=>'',
     *            )
     * )
     * @param array $params
     *
     * @return array
     */
    public static function findByConditions( array $params )
    {
        $DBH = HollyDb::getDBH();
        $conditions = implode(' AND ',$params['conditions']);
        if(empty($conditions))
            $conditions = '1';
        $conditions = ' WHERE ' . $conditions;

        $orderBy = (!empty($params['options']['orderby']))?' ORDER BY ' . $params['options']['orderby']:' ';

        $limit = (!empty($params['options']['limit']))?' LIMIT ' . $params['options']['limit']:' ';
//        echo $conditions."::".$limit;die;
        $STH = $DBH->query('SELECT * from '.static::$tableName .$conditions . $orderBy . $limit);
        $STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
        $results = array();
        while($obj = $STH->fetch())
        {
            $results[] = $obj;
        }
        return $results;
    }

    public static function delete(array $conditions)
    {
        $DBH = HollyDb::getDBH();
        $where = '';
        foreach($conditions as $col=>$condition)
        {
            $where.=' '.$col.' = '.$condition;
        }
        return $DBH->exec("DELETE FROM ".static::$tableName." WHERE ".$where);
    }
}
