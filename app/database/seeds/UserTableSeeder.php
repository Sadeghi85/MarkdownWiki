<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('email' => 'foo@bar.com', 'username' => 'sadeghi85', 'password' => Hash::make('msm1985194')));
    }

}