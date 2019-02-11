<?php

use Illuminate\Database\Seeder;

class VoyagerThemesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('voyager_themes')->delete();
        
        \DB::table('voyager_themes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Default',
                'folder' => 'default',
                'active' => 1,
                'version' => '1.0',
                'created_at' => '2017-09-28 23:08:17',
                'updated_at' => '2017-09-28 23:32:39',
            ),
        ));
        
        
    }
}