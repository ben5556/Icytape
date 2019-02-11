<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 29,
                'user_id' => 15,
                'post_id' => 212,
                'comment' => 'This is too cool. I want this bed :)',
                'created_at' => '2017-12-27 03:20:13',
                'updated_at' => '2017-12-27 03:20:13',
            ),
            1 => 
            array (
                'id' => 30,
                'user_id' => 15,
                'post_id' => 215,
                'comment' => 'Lol! Pan Solo :D',
                'created_at' => '2017-12-27 03:20:13',
                'updated_at' => '2017-12-27 03:20:13',
            ),


    ));
        
        
    }
}