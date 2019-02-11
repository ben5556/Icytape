<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_likes', function(Blueprint $table)
		{
			$table->foreign('post_id')->references('id')->on('posts')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_likes', function(Blueprint $table)
		{
			$table->dropForeign('post_likes_post_id_foreign');
			$table->dropForeign('post_likes_user_id_foreign');
		});
	}

}
