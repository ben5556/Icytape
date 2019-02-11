<?php

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'pages',
                'slug' => 'pages',
                'display_name_singular' => 'Page',
                'display_name_plural' => 'Pages',
                'icon' => 'voyager-file-text',
                'model_name' => 'TCG\\Voyager\\Models\\Page',
                'policy_name' => '',
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'created_at' => '2017-09-28 14:57:26',
                'updated_at' => '2017-12-26 14:55:41',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'created_at' => '2017-09-28 14:57:26',
                'updated_at' => '2017-09-28 14:57:26',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'categories',
                'slug' => 'categories',
                'display_name_singular' => 'Category',
                'display_name_plural' => 'Categories',
                'icon' => 'voyager-categories',
                'model_name' => 'TCG\\Voyager\\Models\\Category',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'created_at' => '2017-09-28 14:57:26',
                'updated_at' => '2017-09-28 14:57:26',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'created_at' => '2017-09-28 14:57:26',
                'updated_at' => '2017-09-28 14:57:26',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'created_at' => '2017-09-28 14:57:26',
                'updated_at' => '2017-09-28 14:57:26',
            ),
            5 => 
            array (
                'id' => 8,
                'name' => 'posts',
                'slug' => 'posts',
                'display_name_singular' => 'Post',
                'display_name_plural' => 'Posts',
                'icon' => 'voyager-photos',
                'model_name' => 'App\\Models\\Post',
                'policy_name' => '',
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 1,
                'created_at' => '2017-09-28 21:07:38',
                'updated_at' => '2017-09-28 21:07:38',
            ),
            6 => 
            array (
                'id' => 9,
                'name' => 'comments',
                'slug' => 'comments',
                'display_name_singular' => 'Comment',
                'display_name_plural' => 'Comments',
                'icon' => 'voyager-bubble',
                'model_name' => 'App\\Models\\Comment',
                'policy_name' => '',
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'created_at' => '2017-12-18 13:51:17',
                'updated_at' => '2017-12-18 13:51:17',
            ),
            7 => 
            array (
                'id' => 10,
                'name' => 'comment_flags',
                'slug' => 'comment-flags',
                'display_name_singular' => 'Comment Flag',
                'display_name_plural' => 'Comment Flags',
                'icon' => 'voyager-warning',
                'model_name' => 'App\\Models\\CommentFlag',
                'policy_name' => '',
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'created_at' => '2017-12-23 05:16:46',
                'updated_at' => '2017-12-23 05:16:46',
            ),
        ));
        
        
    }
}