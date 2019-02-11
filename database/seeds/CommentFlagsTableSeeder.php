<?php

use Illuminate\Database\Seeder;

class CommentFlagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comment_flags')->delete();
        
        
        
    }
}