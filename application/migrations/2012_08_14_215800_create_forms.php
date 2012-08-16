<?php

class Create_Forms {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forms',function($table){
                    $table->increments('id');
                    $table->string('name');
                    $table->text('description');
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('forms');
	}

}