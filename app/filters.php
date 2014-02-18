<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('admin.auth', function(Illuminate\Routing\Route $route, Illuminate\Http\Request $request)
{
    $aAllowedActions = array(
        'Admin\IndexController@getLogin',
        'Admin\IndexController@postLogin',
        'Admin\IndexController@getLogout'
    );
    if ( !Auth::admin()->check() && !in_array($route->getActionName(), $aAllowedActions) )
    {
        Session::flash('error', 'You must be login to view that page');
        return Redirect::to('admin/index/login');
    }
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if ( Auth::user()->check() )
    {
        Session::flash('success', 'You are still login :)');
        return Redirect::to('user/account');
    }
});

Route::filter('auth.anybody', function()
{
    if ( !Auth::user()->check() && !Auth::admin()->check() )
    {
        Session::flash('success', 'Please login first');
        return Redirect::to('user/login');
    }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});