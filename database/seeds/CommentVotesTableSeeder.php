<?php

use Illuminate\Database\Seeder;

class CommentVotesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comment_votes')->delete();
        
        
        
    }
}