<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 1/1/13
 * Time: 6:21 PM
 */
abstract class Input extends BaseModel
{
    public $label;
//    public $default_value;
//    public $name;
    public $type;
    public $data;

    public static function generateInput($type,$params)
    {
        $permitted = array('checkbox','number','text','textArea','password','select','radio');
        if(!in_array($type,$permitted))
            die('Invalid type!');
        $type = 'Input'.ucfirst($type);
        $input = new $type;
        $input->fill($params);
        return $input;
    }

    public function fill($params)
    {
        $vars = get_object_vars($this);
        foreach($vars as $var=>$v)
        {
            $this->$var = isset($params[$var])?$params[$var]:'';
        }
    }
}
