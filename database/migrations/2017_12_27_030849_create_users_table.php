<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->increments('id');
			$table->integer('role_id')->nullable();
			$table->string('username')->unique();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('avatar')->nullable()->default('users/default.png');
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->boolean('active')->default(1);
			$table->timestamps();
			$table->string('activation_token')->nullable();
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
