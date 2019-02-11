<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'avatar' => 'users/default.png',
                'password' => '$2y$10$wj8AKu1z3PNa1jdc/zRNsusJgbEE1yuI6QE26i7kEIWUpclKL3Foe',
                'remember_token' => 'I2BMkFm8KDg7CrzvW1FB39AsUjRYM4LSnYbRjONCFhL2YFnQ5pp6qxXkIBZX',
                'active' => 1,
                'created_at' => '2017-09-28 14:57:26',
                'updated_at' => '2017-12-14 14:11:12',
                'activation_token' => NULL,
            ),
            1 => 
            array (
                'id' => 15,
                'role_id' => 2,
                'username' => 'johndoe',
                'name' => 'johndoe',
                'email' => 'johndoe@gmail.com',
                'avatar' => 'users/default.png',
                'password' => '$2y$10$2ib.kZOE86Hy8ZNzf4i/5eewbdjDlDwMzNTI9b4aFQP3z9NQOXOw.',
                'remember_token' => 'nCn9FmGIBPz6WzE5YtwAgkorEqJgWWqIDx8pwnTtAOlMz8YUvaNx8WRNon1q',
                'active' => 0,
                'created_at' => '2017-12-26 18:31:15',
                'updated_at' => '2017-12-26 18:31:15',
                'activation_token' => '4xUVfjGjm74uXUQ21cj5lFaAlGVopeGxuAj7hUry3KNZSE71BOVwuXqeChvJ2u2b',
            ),
        ));
        
        
    }
}