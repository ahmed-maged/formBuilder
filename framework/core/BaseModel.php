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
        $this->db = DB::get_db();
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
        $tableName = \SystemHelper::remove_namespace(get_called_class());

        $data = get_object_vars($this);

        $collection = $this->db->$tableName;

        $collection->save($data);

        $this->id = $data['_id'];

    }

    public static function all()
    {

        $tableName = \SystemHelper::remove_namespace(get_called_class());

        $db = DB::get_db();

        $collection = $db->$tableName;

        $cursor = $collection->find();

        $results = array();

        foreach ($cursor as $document) {
            $results[] = $document;
        }

        return $results;
    }

    public static function find($id)
    {

        $tableName = \SystemHelper::remove_namespace(get_called_class());

        $mid = new \MongoId($id);

        $db = DB::get_db();

        $collection = $db->$tableName;

        $data = $collection->findOne(array('_id'=>$mid));

        if($data){
            $model = new static;

            foreach($data as $key=>$field){
                if($key === '_id')continue;
                $model->$key = $field;
            }
            $model->id = $id;
            $model->db = $db;
            return $model;
        }

        return false;
    }

    public function delete(){

        $tableName = \SystemHelper::remove_namespace(get_called_class());

        $collection = $this->db->$tableName;

        $id = new \MongoId($this->id);

        $collection->remove(array('_id'=>$id));

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
