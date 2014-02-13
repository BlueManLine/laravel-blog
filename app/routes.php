<?php

Route::controller('user', 'UserController');

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function()
{
    Route::controller('index', 'Admin\IndexController');
    Route::controller('/', 'Admin\IndexController');
});

Route::controller('/', 'IndexController');
