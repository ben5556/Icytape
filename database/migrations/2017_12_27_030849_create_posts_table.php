<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('category_id')->default(1);
			$table->string('title');
			$table->string('slug');
			$table->text('body', 65535)->nullable();
			$table->boolean('active')->default(1);
			$table->boolean('vid')->default(0);
			$table->boolean('pic')->default(1);
			$table->string('pic_url')->nullable();
			$table->text('vid_url', 65535)->nullable();
			$table->string('link_url')->nullable();
			$table->text('tags', 65535)->nullable();
			$table->timestamps();
			$table->boolean('nsfw')->default(0);
			$table->integer('views')->default(0);
			$table->text('pic_url_multi', 65535)->nullable();
			$table->text('delete_img', 65535)->nullable();
		});
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
