<?php

class AdminsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('admins')->truncate();

        $now = date('Y-m-d H:i:s');

		$users = array(
            array('status'=>1,'email'=>'szymon.bluma@polcode.net','nick'=>'admin','password'=>Hash::make('qwe'),'created_at'=>$now,'updated_at'=>$now)
		);

		// Uncomment the below to run the seeder
		DB::table('admins')->insert($users);
	}

}
