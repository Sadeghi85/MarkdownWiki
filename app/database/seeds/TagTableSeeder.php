<?php

class TagTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();

        // Tag::create(array('tag' => 'linux'));
		// Tag::create(array('tag' => 'php'));
    }

}