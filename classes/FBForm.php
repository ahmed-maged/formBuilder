<?php

class FBForm extends BaseModel {
    public static $tableName = 'forms';

    public static $relations = array(
        'data'=>array(
            'model'=>'data',
            'fk'=>'form_id',
            'type'=>'has_many'
        )
    );

}