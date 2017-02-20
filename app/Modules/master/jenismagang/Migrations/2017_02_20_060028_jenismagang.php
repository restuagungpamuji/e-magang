<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Jenismagang Migration
* @var Jenismagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class Jenismagang extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ms_jenis_magang', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nama', 100);
			$table->string('keterangan', 100);
			$table->bigInteger('user_id');
			$table->bigInteger('role_id');

			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
		public function down()
	{
		Schema::drop('ms_jenis_magang');
	}

}
