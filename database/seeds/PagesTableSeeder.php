<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 2,
                'author_id' => 1,
                'title' => 'Contact',
                'excerpt' => NULL,
            'body' => '<p>This is the contact page and you can add pages like this and many other pages inside of the Ninja Media Script Admin dashboard. Simply go to (yoursite.com/admin) and once you have logged in you can visit the page section from the left navigation.</p>
<p>From there you can choose to Add, Edit, Delete any pages.</p>
<p>Remember after you have added the page to your site you may also need to add a link to the page in the Menu Builder.</p>
<p>Thanks again for using Ninja Media Script.</p>
<p>&nbsp;</p>
<h3>Need Support?</h3>
<p>If you are inquiring about contacting Support for this script please visit our forums at <a href="https://devdojo.com/forums" target="_blank" rel="noopener noreferrer">https://devdojo.com/forums</a></p>
<p>-DevDojo</p>',
                'image' => NULL,
                'slug' => 'contact',
                'meta_description' => 'Contact Page',
                'meta_keywords' => NULL,
                'status' => 'ACTIVE',
                'created_at' => '2017-12-26 14:58:08',
                'updated_at' => '2017-12-26 15:18:20',
            ),
        ));
        
        
    }
}