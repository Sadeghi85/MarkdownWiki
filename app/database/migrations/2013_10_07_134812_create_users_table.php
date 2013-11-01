<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			//$table->engine = 'MyISAM';

			$table->increments('id');
			
			$table->string('username')->unique();
			$table->string('email')->nullable();
			$table->string('password');
			
			$table->timestamps();
			
			// ->nullable() 	Designate that the column allows NULL values
			// ->default($value) 	Declare a default value for a column
			// ->unsigned()
			// ->softDeletes();
			// ->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}