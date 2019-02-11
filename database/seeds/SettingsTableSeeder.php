<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Site Title',
                'value' => 'Your Site Name',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Site Description',
                'value' => 'Viral Fun Media Sharing Script',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ),
            2 => 
            array (
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'display_name' => 'Google Analytics Tracking ID',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 6,
                'group' => 'Site',
            ),
            3 => 
            array (
                'id' => 5,
                'key' => 'admin.bg_image',
                'display_name' => 'Admin Background Image',
                'value' => 'settings/October2017/admin-bg.jpg',
                'details' => '',
                'type' => 'image',
                'order' => 5,
                'group' => 'Admin',
            ),
            4 => 
            array (
                'id' => 6,
                'key' => 'admin.title',
                'display_name' => 'Admin Title',
                'value' => 'Ninja Media Script',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            5 => 
            array (
                'id' => 7,
                'key' => 'admin.description',
                'display_name' => 'Admin Description',
                'value' => 'Your Viral Fun Media Sharing Site',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Admin',
            ),
            6 => 
            array (
                'id' => 8,
                'key' => 'admin.loader',
                'display_name' => 'Admin Loader',
                'value' => 'settings/October2017/admin-loader.png',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Admin',
            ),
            7 => 
            array (
                'id' => 9,
                'key' => 'admin.icon_image',
                'display_name' => 'Admin Icon Image',
                'value' => 'settings/October2017/admin-icon1.png',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ),
            8 => 
            array (
                'id' => 10,
                'key' => 'admin.google_analytics_client_id',
            'display_name' => 'Google Analytics Client ID (used for admin dashboard)',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            9 => 
            array (
                'id' => 11,
                'key' => 'site.user_email_verify',
                'display_name' => 'Require User Email Verification?',
                'value' => '0',
                'details' => '',
                'type' => 'checkbox',
                'order' => 7,
                'group' => 'Site',
            ),
            10 => 
            array (
                'id' => 12,
                'key' => 'site.twitter_username',
                'display_name' => 'Twitter Username',
                'value' => 'thedevdojo',
                'details' => '',
                'type' => 'text',
                'order' => 8,
                'group' => 'Site',
            ),
            11 => 
            array (
                'id' => 13,
                'key' => 'site.facebook_page',
                'display_name' => 'Facebook Page/User',
                'value' => 'thedevdojo',
                'details' => '',
                'type' => 'text',
                'order' => 9,
                'group' => 'Site',
            ),
            12 => 
            array (
                'id' => 14,
                'key' => 'site.google_page',
                'display_name' => 'Google+ Page',
                'value' => '+devdojo',
                'details' => '',
                'type' => 'text',
                'order' => 10,
                'group' => 'Site',
            ),
            13 => 
            array (
                'id' => 15,
                'key' => 'site.like_icon',
                'display_name' => 'Like Icon',
                'value' => 'fa-thumbs-o-up',
                'details' => '{
"default": "fa-thumbs-o-up",
"options": {
"fa-thumbs-o-up" : "Thumbs Up",
"fa-star" : "Star",
"fa-heart" : "Heart",
"fa-sun-o" : "Sun",
"fa-smile-o" : "Smile",
"fa-check" : "Checkmark"
}
}',
                'type' => 'select_dropdown',
                'order' => 11,
                'group' => 'Site',
            ),
            16 => 
            array (
                'id' => 18,
                'key' => 'site.favicon',
                'display_name' => 'Site Favicon',
                'value' => 'settings/December2017/jxUsRqHADmGhy4oHBWnf.png',
                'details' => '',
                'type' => 'image',
                'order' => 14,
                'group' => 'Site',
            ),
            17 => 
            array (
                'id' => 19,
                'key' => 'site.auto_approve_posts',
                'display_name' => 'Auto Approve Posts Once Submitted',
                'value' => '0',
                'details' => '',
                'type' => 'checkbox',
                'order' => 28,
                'group' => 'Site',
            ),
            18 => 
            array (
                'id' => 20,
                'key' => 'social-auth.facebook_client_id',
                'display_name' => 'Facebook Client ID',
                'value' => '574958095906653',
                'details' => '',
                'type' => 'text',
                'order' => 15,
                'group' => 'Social Auth',
            ),
            19 => 
            array (
                'id' => 21,
                'key' => 'social-auth.facebook_client_secret',
                'display_name' => 'Facebook Client Secret',
                'value' => '5c02ac2e9ebca3387fb5300e479912f9',
                'details' => '',
                'type' => 'text',
                'order' => 16,
                'group' => 'Social Auth',
            ),
            20 => 
            array (
                'id' => 22,
                'key' => 'social-auth.google_client_id',
                'display_name' => 'Google Client ID',
                'value' => '13497725668-gnajm77hup5grcr9ldel4srioi0qt857.apps.googleusercontent.com',
                'details' => '',
                'type' => 'text',
                'order' => 17,
                'group' => 'Social Auth',
            ),
            21 => 
            array (
                'id' => 24,
                'key' => 'social-auth.google_client_secret',
                'display_name' => 'Google Client Secret',
                'value' => 'NwZ-40lreMmg9e7NqH5loJ-u',
                'details' => '',
                'type' => 'text',
                'order' => 19,
                'group' => 'Social Auth',
            ),
            22 => 
            array (
                'id' => 25,
                'key' => 'mail.driver',
            'display_name' => 'Mail Driver (ex. smtp, mailgun, etc)',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 20,
                'group' => 'Mail',
            ),
            23 => 
            array (
                'id' => 26,
                'key' => 'mail.host',
            'display_name' => 'Mail Host (ex. mailtrap.io)',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 21,
                'group' => 'Mail',
            ),
            24 => 
            array (
                'id' => 27,
                'key' => 'mail.port',
            'display_name' => 'Mail Port (ex. 2525)',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 22,
                'group' => 'Mail',
            ),
            25 => 
            array (
                'id' => 28,
                'key' => 'mail.username',
                'display_name' => 'Mail Username or Email',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 23,
                'group' => 'Mail',
            ),
            26 => 
            array (
                'id' => 29,
                'key' => 'mail.password',
                'display_name' => 'Mail Password',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 24,
                'group' => 'Mail',
            ),
            27 => 
            array (
                'id' => 30,
                'key' => 'mail.encryption',
                'display_name' => 'Mail Encryption',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 25,
                'group' => 'Mail',
            ),
            28 => 
            array (
                'id' => 31,
                'key' => 'mail.mailgun_domain',
            'display_name' => 'Mailgun Domain (Only if Using Mailgun Driver)',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 26,
                'group' => 'Mail',
            ),
            29 => 
            array (
                'id' => 32,
                'key' => 'mail.mailgun_secret',
            'display_name' => 'Mailgun Secret (Only if Using Mailgun Driver)',
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 27,
                'group' => 'Mail',
            ),
            30 => 
            array (
                'id' => 33,
                'key' => 'site.debug',
            'display_name' => 'Debug Mode (turn on to get error messages)',
                'value' => '1',
                'details' => '',
                'type' => 'checkbox',
                'order' => 29,
                'group' => 'Site',
            ),
            31 => 
            array (
                'id' => 34,
                'key' => 'site.demo_mode',
            'display_name' => 'Demo Mode',
                'value' => '0',
                'details' => '',
                'type' => 'checkbox',
                'order' => 30,
                'group' => 'Site',
            ),
            32 => 
            array (
                'id' => 35,
                'key' => 'site.url',
                'display_name' => 'Site URL',
                'value' => 'http://ninja-media-script.dev',
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
            ),
        ));
        
        
    }
}