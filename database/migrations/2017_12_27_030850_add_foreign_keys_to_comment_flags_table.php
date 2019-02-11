<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCommentFlagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comment_flags', function(Blueprint $table)
		{
			$table->foreign('comment_id')->references('id')->on('comments')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('comment_flags', function(Blueprint $table)
		{
			$table->dropForeign('comment_flags_comment_id_foreign');
			$table->dropForeign('comment_flags_user_id_foreign');
		});
	}

}
