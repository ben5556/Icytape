<?php

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

/*
|--------------------------------------------------------------------------
| Ninja Media Script Routes
|--------------------------------------------------------------------------
|
*/

Route::get('test', function(){ echo 'test'; });

// ********** Single Install Route ********** //
Route::get('install', 'InstallController@install');
Route::get('install_complete', 'InstallController@install_complete');

// **********	HOME/ROOT ROUTE *********//
Route::get('/', 'HomeController@home');



// ********* CATEGORY ROUTE ********** //
Route::get('category/{category}', 'PostController@category');


// ********** USER AUTHENTICATION ROUTES  ********** //

// LOGIN

Route::get('login', 'UserController@login');
Route::post('login', 'UserController@login_post');

// SIGNUP

Route::get('signup', 'UserController@signup');
Route::post('signup', 'UserController@signup_post');

// VERIFY & LOGOUT

Route::get('/verify/{token}', 'UserController@verify')->name('email.verify');
Route::get('logout', 'UserController@logout');

// OAUTH ROUTES

Route::get('login/facebook', 'UserController@facebookRedirect');
Route::get('login/facebook/callback', 'UserController@facebookCallback');

Route::get('login/google', 'UserController@googleRedirect');
Route::get('login/google/callback', 'UserController@googleCallback');


// PASSWORD RESET

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');



// ********* POPULAR ROUTE ********** //

Route::get('popular', 'PopularController@index');
Route::get('popular/week', 'PopularController@week');
Route::get('popular/month', 'PopularController@month');
Route::get('popular/year', 'PopularController@year');


// **********	RANDOM MEDIA ROUTE ********** //

Route::get('random', 'PostController@random');

// **********	POINTS / FLAGS / LIKE ROUTES ********** //

Route::post('add_user_point', 'UserController@add_user_point');
Route::post('post/add_flag', 'PostController@add_flag');
Route::post('post/add_like', 'PostController@add_like');
Route::post('post/add_flag', 'UserController@add_flag');

// ********** Front-End Viewing Options ********** //

Route::get('view/list', 'ViewSettingsController@list');
Route::get('view/grid', 'ViewSettingsController@grid');
Route::get('view/grid_large', 'ViewSettingsController@grid_large');
Route::get('view/sidebar_toggle', 'ViewSettingsController@sidebar_toggle');

// ********** COMMENTS ROUTES  **********//

Route::post('comments', 'CommentsController@store');
Route::patch('comments/{id}', 'CommentsController@update');
Route::delete('comments/{id}', 'CommentsController@destroy');
Route::post('comments/vote_up', 'CommentsController@vote_up');
Route::post('comments/vote_down', 'CommentsController@vote_down');
Route::post('comments/add_flag', 'CommentsController@add_flag');
Route::get('comments/votes/{id}', 'CommentsController@getCommentVotes');
Route::get('comments/flags/{id}', 'CommentsController@getCommentFlags');
Route::post('notification', 'CommentsController@ajax_notification');

Route::get('images/{path}', 'ImageController@show')->where('path', '.*');


// ********* TAGS ROUTE ********** //

Route::get('tags/{tag}', 'PostController@tags');

// **********	USER ROUTES   ********** //

Route::get('user/{username}', 'UserController@profile');
Route::get('user/{username}/likes', 'UserController@profile_likes');
Route::get('user/{username}/points', 'UserController@points');
Route::post('user/update/{id}', 'UserController@update');

/********** Upload Routes **********/
Route::get('upload', 'PostController@create');
Route::post('upload', 'PostController@create');
Route::post('image_ajax_upload', 'PostController@image_ajax_upload');
Route::resource('post', 'PostController');
Route::get('post/delete/{id}', 'PostController@delete');

/********** Leaderboard Page **********/
Route::get('leaderboard', 'UserController@leaderboard');

/********** Page Routes **********/
Route::get('page/{slug}', 'PageController@show');

/********** SITEMAP **********/
Route::get('sitemap.xml', 'PostController@sitemap');

// **********	SINGLE POST ROUTE ********** //
Route::get('{slug}', 'PostController@show');