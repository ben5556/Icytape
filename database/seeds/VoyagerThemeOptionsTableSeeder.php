<?php

use Illuminate\Database\Seeder;

class VoyagerThemeOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('voyager_theme_options')->delete();
        
        \DB::table('voyager_theme_options')->insert(array (
            0 => 
            array (
                'id' => 3,
                'voyager_theme_id' => 1,
                'key' => 'logo_light',
                'value' => 'themes/September2017/light-logo.png',
                'created_at' => '2017-09-29 00:26:09',
                'updated_at' => '2017-09-29 00:26:09',
            ),
            1 => 
            array (
                'id' => 4,
                'voyager_theme_id' => 1,
                'key' => 'logo_dark',
                'value' => 'themes/September2017/dark-logo1.png',
                'created_at' => '2017-09-29 00:26:09',
                'updated_at' => '2017-09-29 00:33:39',
            ),
            2 => 
            array (
                'id' => 5,
                'voyager_theme_id' => 1,
                'key' => 'color_scheme',
                'value' => 'dark',
                'created_at' => '2017-09-29 15:11:18',
                'updated_at' => '2017-12-23 16:42:02',
            ),
            3 => 
            array (
                'id' => 8,
                'voyager_theme_id' => 1,
                'key' => 'default_color',
                'value' => '#ee222e',
                'created_at' => '2017-09-29 23:58:41',
                'updated_at' => '2017-09-30 00:29:21',
            ),
            4 => 
            array (
                'id' => 9,
                'voyager_theme_id' => 1,
                'key' => 'random_bar',
                'value' => '1',
                'created_at' => '2017-09-29 23:59:25',
                'updated_at' => '2017-12-13 15:22:13',
            ),
            5 => 
            array (
                'id' => 11,
                'voyager_theme_id' => 1,
                'key' => 'pagination_type',
                'value' => 'infinite_scroll',
                'created_at' => '2017-12-09 23:16:34',
                'updated_at' => '2017-12-11 15:17:29',
            ),
            6 => 
            array (
                'id' => 12,
                'voyager_theme_id' => 1,
                'key' => 'custom_js',
                'value' => '',
                'created_at' => '2017-12-10 15:30:28',
                'updated_at' => '2017-12-10 15:32:32',
            ),
            7 => 
            array (
                'id' => 13,
                'voyager_theme_id' => 1,
                'key' => 'post_display',
                'value' => 'list',
                'created_at' => '2017-12-11 17:26:46',
                'updated_at' => '2017-12-11 17:46:24',
            ),
            8 => 
            array (
                'id' => 14,
                'voyager_theme_id' => 1,
                'key' => 'sidebar',
                'value' => '1',
                'created_at' => '2017-12-11 21:05:46',
                'updated_at' => '2017-12-11 21:42:30',
            ),
            9 => 
            array (
                'id' => 15,
                'voyager_theme_id' => 1,
                'key' => 'sidebar_settings',
                'value' => '1',
                'created_at' => '2017-12-11 21:05:46',
                'updated_at' => '2017-12-11 21:32:33',
            ),
            10 => 
            array (
                'id' => 16,
                'voyager_theme_id' => 1,
                'key' => 'open_posts',
                'value' => '0',
                'created_at' => '2017-12-13 15:38:50',
                'updated_at' => '2017-12-13 15:39:59',
            ),
            11 => 
            array (
                'id' => 17,
                'voyager_theme_id' => 1,
                'key' => 'like_icon',
                'value' => 'fa-thumbs-up',
                'created_at' => '2017-12-14 15:01:12',
                'updated_at' => '2017-12-14 15:05:33',
            ),
            12 => 
            array (
                'id' => 18,
                'voyager_theme_id' => 1,
                'key' => 'social_share_image',
                'value' => 'themes/December2017/J1rzV6uN6Qsd4WnRbZhU.jpg',
                'created_at' => '2017-12-16 03:28:48',
                'updated_at' => '2017-12-16 03:28:48',
            ),
            13 => 
            array (
                'id' => 19,
                'voyager_theme_id' => 1,
                'key' => 'ad_sidebar',
                'value' => '<a href="http://codecanyon.net/item/ninja-media-script-viral-fun-media-sharing-site/6822888" target="_blank"><img src="/themes/default/assets/img/advertisement.jpg" width="302" height="252"></a>',
                'created_at' => '2017-12-19 14:38:50',
                'updated_at' => '2017-12-19 14:43:38',
            ),
            14 => 
            array (
                'id' => 20,
                'voyager_theme_id' => 1,
                'key' => 'ad_post_top',
                'value' => '<a href="http://codecanyon.net/item/ninja-media-script-viral-fun-media-sharing-site/6822888" target="_blank"><img src="/themes/default/assets/img/top-advertisement.jpg" width="728" height="90"></a>',
                'created_at' => '2017-12-19 14:38:50',
                'updated_at' => '2017-12-19 14:38:50',
            ),
            15 => 
            array (
                'id' => 23,
                'voyager_theme_id' => 1,
                'key' => 'custom_css',
                'value' => '',
                'created_at' => '2017-12-26 15:21:52',
                'updated_at' => '2017-12-26 15:22:40',
            ),
        ));
        
        
    }
}