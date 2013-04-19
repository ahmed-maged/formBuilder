<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 1/2/13
 * Time: 3:13 AM
 */

namespace models;

class Entry extends \db\ActiveRecord
{
    public $id;
    public $form_id;
    public $inputs = array();
}
