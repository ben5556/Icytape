<?php

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('points')->delete();
        
        \DB::table('points')->insert(array (
            0 => 
            array (
                'id' => 85,
                'user_id' => 15,
                'points' => 5,
                'description' => 'Daily Login',
                'created_at' => '2017-12-27 03:19:59',
                'updated_at' => '2017-12-27 03:19:59',
            ),
            1 => 
            array (
                'id' => 86,
                'user_id' => 15,
                'points' => 1,
                'description' => 'Daily Comment',
                'created_at' => '2017-12-27 03:20:13',
                'updated_at' => '2017-12-27 03:20:13',
            ),
            2 => 
            array (
                'id' => 87,
                'user_id' => 1,
                'points' => 5,
                'description' => 'Daily Login',
                'created_at' => '2017-12-27 03:20:28',
                'updated_at' => '2017-12-27 03:20:28',
            ),
        ));
        
        
    }
}