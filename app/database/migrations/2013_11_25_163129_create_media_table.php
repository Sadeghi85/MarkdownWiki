<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media', function(Blueprint $table)
		{
			//$table->engine = 'MyISAM';
			
			$table->increments('id');
			$table->string('name');
			$table->integer('size');
			$table->binary('content');
			
			$table->timestamps();
			
		});

		DB::statement('ALTER TABLE `media` MODIFY COLUMN `content` LONGBLOB NOT NULL;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('media');
	}

}
