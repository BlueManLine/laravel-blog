<?php

Route::controller('user', 'UserController');
Route::get('post/{slug}', 'PostsController@showBySlug')
    ->where('slug', '[\-_A-Za-z0-9]+');

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function()
{
    Route::controller('index', 'Admin\IndexController');
    Route::controller('posts', 'Admin\PostsController');

    Route::controller('/', 'Admin\IndexController');
});

Route::controller('/', 'IndexController');
