<?php

use Illuminate\Database\Seeder;

class PostLikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_likes')->delete();
        
        \DB::table('post_likes')->insert(array (
            0 => 
            array (
                'id' => 28,
                'user_id' => 1,
                'post_id' => 216,
                'created_at' => '2017-12-27 03:19:26',
                'updated_at' => '2017-12-27 03:19:26',
            ),
            1 => 
            array (
                'id' => 29,
                'user_id' => 1,
                'post_id' => 214,
                'created_at' => '2017-12-27 03:19:28',
                'updated_at' => '2017-12-27 03:19:28',
            ),
            2 => 
            array (
                'id' => 30,
                'user_id' => 1,
                'post_id' => 212,
                'created_at' => '2017-12-27 03:19:30',
                'updated_at' => '2017-12-27 03:19:30',
            ),
            3 => 
            array (
                'id' => 31,
                'user_id' => 1,
                'post_id' => 206,
                'created_at' => '2017-12-27 03:19:33',
                'updated_at' => '2017-12-27 03:19:33',
            ),
        ));
        
        
    }
}