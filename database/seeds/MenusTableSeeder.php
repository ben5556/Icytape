<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'created_at' => '2017-09-28 14:57:26',
                'updated_at' => '2017-09-28 14:57:26',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'main',
                'created_at' => '2017-12-14 17:44:59',
                'updated_at' => '2017-12-14 17:44:59',
            ),
        ));
        
        
    }
}