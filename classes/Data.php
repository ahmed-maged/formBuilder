<?php

class Data extends Eloquent{
    public static $table = 'data';
    public static $timestamps = false;
    
    public function input()
    {
        return $this->belongs_to('FBInput','input_id');
    }
    
    public function form()
    {
        return $this->belongs_to('FBForm','form_id');
    }
}