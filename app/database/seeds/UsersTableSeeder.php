<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

        $now = date('Y-m-d H:i:s');

		$users = array(
            array('email'=>'szymon.bluma@polcode.net','nick'=>'BlueMan','pass'=>Hash::make('qwe'),'ip_created'=>'localhost','created_at'=>$now,'updated_at'=>$now)
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
