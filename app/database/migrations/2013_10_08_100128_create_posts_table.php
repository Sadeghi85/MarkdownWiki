<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';
			
			$table->increments('id');
			$table->enum('published', array('0', '1'))->default('0');
			$table->enum('list', array('0', '1'))->default('0');
			$table->string('title');
			$table->string('alias')->unique();
			$table->string('main_tag');
			$table->text('content');
			$table->string('search_title');
			$table->text('search_content');
			$table->timestamps();
			
			$table->softDeletes();
		});

		DB::statement('ALTER TABLE `posts` ADD FULLTEXT search_fulltext (`search_title`, `search_content`)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
