<?php

class FBInput extends Eloquent{
    public static $table = 'inputs';
    public static $timestamps = false;
    
    public function form()
    {
        return $this->belongs_to('FBForm');
    }
    
    public function data()
    {
        return $this->has_many('data');
    }
}