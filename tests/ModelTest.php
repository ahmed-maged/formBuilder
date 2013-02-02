<?php

spl_autoload_register(function ($class) {
    // put the path to your class files here
    $my_path = "classes\\";

    // tell PHP to scan the default include paht AND your include path
    set_include_path(get_include_path() . PATH_SEPARATOR . $my_path);

    // name your classes and filenames with underscores, i.e., Net_Whois stored in Net_Whois.php
    $classfile = str_replace("_", "\\", $class) . ".php";
    @include_once($classfile.'');
//    include 'classes/' . $class . '.php';
});

spl_autoload_register(function ($class) {
    @include '../classes/' . $class . '.php';
});


require_once '../classes/BaseController.php';
require_once '../controllers/Controller.php';

class MySqlFormsTest extends PHPUnit_Extensions_Database_TestCase
{

    protected function getDataSet()
    {
        return $this->createXMLDataSet('modelFixtures.xml');
    }

    public function getConnection()
    {
        $database = 'formbuilder_test';
        $pdo = new PDO("mysql:host=localhost;dbname=$database", 'root', '');
        return $this->createDefaultDBConnection($pdo, $database);
    }

    public function test_find()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('forms'), "Pre-Condition");
        $form = FBForm::find(1);
        $this->assertEquals('form1',$form->name);
        $this->assertEquals('form1',$form->props['name']);
    }

    public function test_delete()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('forms'), "Pre-Condition");
        $form = FBForm::delete(array('id'=>1));
        $this->assertEquals(1, $this->getConnection()->getRowCount('forms'), "Rows not deleted!");
        $this->assertEquals(1, $form, "Rows not deleted!");
    }

    public function test_all()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('forms'), "Pre-Condition");
        $forms = FBForm::all();
        $this->assertEquals(2, count($forms), "Rows not fetched!");
    }

    public function test_save()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('forms'), "Pre-Condition");

        $form = new Entry();
        $form->form_id = '50e39550360a038c2c000002';
        $form->inputs = array('dfs','qwq');
        $form->save();
        echo 'id='. $form->id.':::<br>';
        echo 'form_id='. $form->form_id.':::<br>';

        $this->assertEquals(3, $form->id, "Did not save new id to object!");
        $this->assertEquals(3, $this->getConnection()->getRowCount('forms'), "Did not save!");
    }

    public function test_relations()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('forms'), "Pre-Condition");
        $this->assertEquals(3, $this->getConnection()->getRowCount('data'), "Pre-Condition");
        $form = FBForm::find(1);
        $form->data()->delete();
        $this->assertEquals(1, $this->getConnection()->getRowCount('data'), "Pre-Condition");
    }

    public function test_findByConditions()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('forms'), "Pre-Condition");

        $params = array(
            'conditions'=>array(
                'name = "form1"'
            ),
            'options'=>array(
//                'orderby'=>'id',
//                'limit'=>'1'
            )
        );
        $forms = FBForm::findByConditions($params);
        $this->assertEquals(1, count($forms),'Should select 1 row!');
        $this->assertEquals(1, $forms[0]->id,'Should select row with id 1');
        $params = array(
            'conditions'=>array(
//                'name = "form1"'
            ),
            'options'=>array(
                'orderby'=>'id DESC',
                'limit'=>'1'
            )
        );
        $forms = FBForm::findByConditions($params);
        $this->assertEquals(1, count($forms),'Limit is not working!');
        $this->assertEquals(2, $forms[0]->id,'ORDER BY failed!');
//        $this->assertEquals(1, $forms[0]->id);
    }


}