<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIdToMigrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('migrations', function(Blueprint $table) {
            $table->increments('id');
            $table->engine = 'MyISAM';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('migrations', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->dropColumn('id');
		});
	}

}
