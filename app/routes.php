<?php

Route::controller('user', 'UserController');

Route::group(array('prefix' => 'admin'), function()
{
    //Route::resource('posts', 'Admin\PostsController');

    Route::controller('/', 'Admin\IndexController');
});

Route::controller('/', 'IndexController');
