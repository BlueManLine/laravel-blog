<?php

class UserController extends BaseController
{

    public function getRegister()
	{
        return View::make('user.register');
	}

    // http://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers

    public function postRegister()
    {
        $rules = array(
            'nick'      => array('required', 'unique:users,nick'),
            'email'     => array('required', 'email', 'unique:users,email'),
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            // Validation has failed.
            Session::flash('message', 'WOW! Some errors happen!');
            return Redirect::to('user/register')->withInput()->withErrors($validation);
        }
        else
        {
            // redirect
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('user/register');
        }
    }

    public function getLogin()
    {
        return View::make('user.login');
    }

}