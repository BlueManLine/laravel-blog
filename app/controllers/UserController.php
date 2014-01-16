<?php

class UserController extends BaseController
{

    public function getRegister()
	{
        return View::make('user.register');
	}

    public function postRegister()
    {
        return View::make('user.register');
    }

    public function getLogin()
    {
        return View::make('user.login');
    }

}