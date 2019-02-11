<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
                'order' => 33,
                'created_at' => '2013-10-24 16:41:57',
                'updated_at' => '2014-01-28 15:25:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Animals',
                'slug' => 'animals',
                'order' => 1,
                'created_at' => '2013-10-18 15:57:00',
                'updated_at' => '2014-01-28 15:45:25',
            ),
            2 => 
            array (
                'id' => 25,
                'name' => 'News',
                'slug' => 'news',
                'order' => 24,
                'created_at' => '2013-10-24 16:40:46',
                'updated_at' => '2013-10-24 16:40:46',
            ),
            3 => 
            array (
                'id' => 29,
                'name' => 'Sports',
                'slug' => 'sports',
                'order' => 31,
                'created_at' => '2013-10-24 16:41:30',
                'updated_at' => '2014-01-26 17:22:09',
            ),
            4 => 
            array (
                'id' => 31,
                'name' => 'Comics',
                'slug' => 'comics',
                'order' => 18,
                'created_at' => '2014-01-28 14:59:34',
                'updated_at' => '2014-01-28 16:00:58',
            ),
            5 => 
            array (
                'id' => 32,
                'name' => 'Cartoon',
                'slug' => 'cartoon',
                'order' => 3,
                'created_at' => '2014-01-28 15:25:09',
                'updated_at' => '2014-01-28 15:25:09',
            ),
            6 => 
            array (
                'id' => 33,
                'name' => 'Music',
                'slug' => 'music',
                'order' => 22,
                'created_at' => '2014-01-28 15:44:11',
                'updated_at' => '2014-01-28 15:44:11',
            ),
            7 => 
            array (
                'id' => 34,
                'name' => 'Architecture',
                'slug' => 'architecture',
                'order' => 2,
                'created_at' => '2014-01-28 15:45:15',
                'updated_at' => '2014-01-28 15:45:31',
            ),
            8 => 
            array (
                'id' => 35,
                'name' => 'Film',
                'slug' => 'film',
                'order' => 20,
                'created_at' => '2014-01-28 16:00:22',
                'updated_at' => '2014-01-28 16:00:22',
            ),
            9 => 
            array (
                'id' => 36,
                'name' => 'Family',
                'slug' => 'family',
                'order' => 19,
                'created_at' => '2014-01-28 16:01:08',
                'updated_at' => '2014-01-28 16:01:08',
            ),
            10 => 
            array (
                'id' => 37,
                'name' => 'Comedy',
                'slug' => 'comedy',
                'order' => 13,
                'created_at' => '2014-01-31 04:11:41',
                'updated_at' => '2014-01-31 04:11:41',
            ),
            11 => 
            array (
                'id' => 38,
                'name' => 'Vehicles',
                'slug' => 'vehicles',
                'order' => 38,
                'created_at' => '2014-01-31 04:20:05',
                'updated_at' => '2014-01-31 04:20:05',
            ),
            12 => 
            array (
                'id' => 39,
                'name' => 'Food',
                'slug' => 'food',
                'order' => 21,
                'created_at' => '2014-01-31 04:46:00',
                'updated_at' => '2014-01-31 04:46:00',
            ),
            13 => 
            array (
                'id' => 40,
                'name' => 'Retro',
                'slug' => 'retro',
                'order' => 25,
                'created_at' => '2014-02-04 04:38:23',
                'updated_at' => '2017-12-23 05:02:56',
            ),
        ));
        
        
    }
}