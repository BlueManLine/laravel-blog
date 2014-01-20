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
            Session::flash('error', 'WOW! Some errors happen!');
            return Redirect::to('user/register')->withInput()->withErrors($validation);
        }
        else
        {
            // store
            $oUser = new User();
            $oUser->email = Input::get('email');
            $oUser->nick = Input::get('nick');
            $oUser->ip_created = Request::getClientIp();
            $bSaved = $oUser->save();

            if( $bSaved )
            {
                // sending confirmation email
                $data = array(
                    'nick' => Input::get('nick')
                );
                try {
                    Mail::send('emails.welcome', $data, function($message)
                    {
                        $message->to(Input::get('email'), 'Szymon Bluma')
                            ->subject('Welcome!');
                    });
                } catch(Exception $e) {
                    User::destroy($oUser->id);
                    throw $e;
                }
                Session::flash('success', 'Successfully created nerd!');
            }
            else
            {
                Session::flash('error', 'Sorry, we cant save the record right now :/');
            }

            return Redirect::to('user/register');
        }
    }

    public function getLogin()
    {
        return View::make('user.login');
    }

}