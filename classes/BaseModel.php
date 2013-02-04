<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 10:15 PM
 */
class BaseModel
{

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
//        if(!$this->validate())
//            return false;

        $tableName = get_called_class();
//        echo $tableName;die;
        $data = get_object_vars($this);
//        print_r($data);die;
        $m = new MongoClient();
        $db = $m->formbuilder;
        $collection = $db->$tableName;
        $collection->insert($data);
        $this->id = $data['_id'];
//        echo $this->id;
    }

    public static function all()
    {
        $tableName = get_called_class();
        $m = new MongoClient();
        $db = $m->formbuilder;
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
        $tableName = get_called_class();
        $id = new MongoId($id);
        $m = new MongoClient();
        $db = $m->formbuilder;
        $collection = $db->$tableName;
        return $collection->findOne(array('_id'=>$id));
    }

    public static function delete(array $filter)
    {
        $tableName = get_called_class();
        $m = new MongoClient();
        $db = $m->formbuilder;
        $collection = $db->$tableName;
        $collection->remove($filter);
    }
}
