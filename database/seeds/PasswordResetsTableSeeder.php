<?php

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'tnylea@gmail.com',
                'token' => '$2y$10$j6YJaJoHkCFOBiB9DJEMfOzi3O7RyMAQ81l2Xun9JycEmj3KxLrci',
                'created_at' => '2017-12-23 21:48:10',
            ),
        ));
        
        
    }
}