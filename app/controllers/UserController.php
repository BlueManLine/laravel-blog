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
            $oUser->status = User::status_inactive;
            $oUser->hash = User::generateHash();
            $oUser->email = Input::get('email');
            $oUser->nick = Input::get('nick');
            $oUser->ip_created = Request::getClientIp();
            $bSaved = $oUser->save();

            if( $bSaved )
            {
                // sending confirmation email
                $data = array(
                    'nick' => $oUser->nick,
                    'hash' => $oUser->hash,
                );
                try {
                    Mail::send('emails.welcome', $data, function($message)
                    {
                        $message->to(Input::get('email'), Input::get('nick'))
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

    public function getActivate($hash=null)
    {
        if( is_null($hash) )
        {
            Session::flash('error', 'Mismatch registration hash param');
            return Redirect::to('user/register');
        }

        $account = User::where('hash','=', $hash)
                    ->where('status', '=', User::status_inactive)
                    ->take(1)->get();

        if( !empty($account) )
        {
            $userPassword = str_random(8);

            $user = User::find($account[0]['id']);
            $user->status = User::status_active;
            $user->password = Hash::make($userPassword);
            $user->hash = NULL;
            $user->save();

            $data = array(
                'nick' => $user->nick,
                'password' => $userPassword,
            );
            Mail::send('emails.password', $data, function($message) use ($user)
            {
                $message->to($user->email, $user->nick)
                    ->subject('Your new password');
            });

            Session::flash('success', 'Account has been activated and password hass been send to you');
            return Redirect::to('user/login');
        }
        else
        {
            Session::flash('error', 'The account doesnt exists');
            return Redirect::to('user/register');
        }
    }

    public function getLogin()
    {
        return View::make('user.login');
    }

}