<?php

namespace Admin;

class IndexController extends \BaseController
{

    public function getIndex()
	{
        if (!\Auth::admin()->check())
        {
            return \Redirect::to('admin/index/login');
        }

        return \View::make('admin/index/index');
	}

    public function getLogin()
    {
        if (\Auth::admin()->check())
        {
            return \Redirect::to('admin');
        }

        return \View::make('admin/index/login');
    }

    public function postLogin()
    {
        if (\Auth::admin()->check())
        {
            return \Redirect::to('admin');
        }

        $rules = array(
            'email'     => array('required', 'email'),
            'password'  => array('required'),
        );

        $validation = \Validator::make(\Input::all(), $rules);

        if ( !$validation->fails() )
        {
            if (\Auth::admin()->attempt(array('email' => \Input::get('email'), 'password' => \Input::get('password'))))
            {
                return \Redirect::intended('admin');    // redirecting to dashboard
            }
        }

        // Validation has failed.
        \Session::flash('error', 'Incorrect email or password');
        return \Redirect::to('admin/index/login')->withInput()->withErrors($validation);
    }

}
