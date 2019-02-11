<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => 31,
                'user_id' => 1,
                'content' => 'johndoe commented on "Nintendo Bed"',
                'is_read' => 1,
                'url' => '/nintendo-bed',
                'created_at' => '2017-12-27 03:20:13',
                'updated_at' => '2017-12-27 03:20:31',
            ),
        ));
        
        
    }
}