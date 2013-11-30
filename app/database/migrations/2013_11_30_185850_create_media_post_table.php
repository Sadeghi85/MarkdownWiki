<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media_post', function(Blueprint $table)
		{
			//$table->engine = 'MyISAM';
			
			$table->increments('id');
			$table->integer('media_id');
			$table->integer('post_id');
			$table->text('comment');
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('media_post');
	}

}
