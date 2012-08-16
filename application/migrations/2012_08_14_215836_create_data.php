<?php

class Create_Data {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data',function($table){
                    $table->increments('id');
                    $table->integer('form_number');
                    $table->integer('form_id');
                    $table->integer('input_id');
                    $table->text('data');
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data');
	}

}