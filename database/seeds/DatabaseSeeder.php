<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $this->call(CategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CommentFlagsTableSeeder::class);
        $this->call(CommentVotesTableSeeder::class);
        $this->call(DataTypesTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(OauthFacebookTableSeeder::class);
        $this->call(OauthGoogleTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionGroupsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(PointsTableSeeder::class);
        $this->call(PostFlagsTableSeeder::class);
        $this->call(PostLikesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(VoyagerThemesTableSeeder::class);
        $this->call(VoyagerThemeOptionsTableSeeder::class);
    }
}
