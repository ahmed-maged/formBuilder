<?php

class Create_Inputs {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inputs',function($table){
                    $table->increments('id');
                    $table->integer('form_id');
                    $table->string('type');
                    $table->string('rules');
                    $table->string('name');
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inputs');
	}

}