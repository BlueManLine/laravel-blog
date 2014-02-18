<?php

Route::controller('user', 'UserController');

Route::get('post/{slug}', 'PostsController@showBySlug')->where('slug', '[\-_A-Za-z0-9]+');
Route::post('post/{slug}', array('before' => 'auth.anybody', 'uses' => 'PostsController@saveComment'))->where('slug', '[\-_A-Za-z0-9]+');

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function()
{
    Route::controller('index', 'Admin\IndexController');
    Route::controller('posts', 'Admin\PostsController');
    Route::controller('users', 'Admin\UsersController');
    Route::controller('comments', 'Admin\CommentsController');

    Route::controller('/', 'Admin\IndexController');
});

Route::controller('/', 'IndexController');
