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

    public function getConnection()
    {
        $database = 'formbuilder_test';
        $pdo = new PDO("mysql:host=localhost;dbname=$database", 'root', '');
        return $this->createDefaultDBConnection($pdo, $database);
    }

    public function test_post_index2()
    {
        $_POST = Array
        (
            'submit' => 'Save Form',
            'formName' => 'Test Form',
            'formDesc' => 'Hi this is a test form!',
        );
        $this->assertEquals(0, $this->getConnection()->getRowCount('forms'), "Pre-Condition");
        $controller = new Controller();
        $controller->post_index();
        $this->assertEquals(1, $this->getConnection()->getRowCount('forms'), "Inserting failed!");
    }

    public function test_post_index1()
    {
        $_POST = Array
        (
            'submit' => 'Save Form',
            'formName' => 'Test Form',
            'formDesc' => 'Hi this is a test form!',
            'inputs' => Array
            (
                Array
                (
                    'label' => 'the text input',
                    'type' => 'text'
                ),

                Array
                (
                    'label' => 'ta',
                    'type' => 'textArea'
                ),

                Array
                (
                    'label' => 'cb',
                    'type' => 'checkbox'
                )
            )
        );
        $this->assertEquals(0, $this->getConnection()->getRowCount('forms'), "Pre-Condition");
        $this->assertEquals(0, $this->getConnection()->getRowCount('inputs'), "Pre-Condition");
        $controller = new Controller();
        $controller->post_index();
        $this->assertEquals(1, $this->getConnection()->getRowCount('forms'), "Inserting failed!");
        $this->assertEquals(3, $this->getConnection()->getRowCount('inputs'), "Inserting failed!");
    }

    protected function getDataSet()
    {
        return $this->createXMLDataSet('fixtures.xml');
    }
}