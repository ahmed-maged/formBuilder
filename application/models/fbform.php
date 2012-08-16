<?php

class FBForm extends Eloquent{
    public static $table = 'forms';
    public static $timestamps = false;
    
    public function inputs()
    {
        return $this->has_many('FBInput','form_id');
    }
    public function data()
    {
        return $this->has_many('data','form_id');
    }
}