<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 1/2/13
 * Time: 3:12 AM
 */

namespace models;

class Form extends \core\BaseModel
{
    public $id;
    public $name;
    public $description;
    public $inputs = array();
}
