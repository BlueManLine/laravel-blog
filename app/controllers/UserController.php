<?php

class UserController extends BaseController
{

    public function __construct()
    {
        //$this->beforeFilter('auth', array('only'=>array('getAccount')));
        //$this->beforeFilter('guest', array('only'=>array('')));
    }

    public function getRegister()
	{
        return View::make('user.register');
	}

    // http://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers

    public function postRegister()
    {
        if (Auth::check())
        {
            Session::flash('success', 'You are still login :)');
            return Redirect::to('user/account');
        }

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

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind()
    {
        return View::make('user.remind');
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        $rules = array(
            'email'     => array('required', 'email'),
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            // Validation has failed.
            Session::flash('error', 'WOW! Some errors happen!');
            return Redirect::to('user/remind')->withInput()->withErrors($validation);
        }
        else
        {
            switch ($response = Password::remind(Input::only('email')))
            {
                case Password::INVALID_USER:
                    return Redirect::back()->with('error', Lang::get($response));

                case Password::REMINDER_SENT:
                    return Redirect::back()->with('status', Lang::get($response));
            }
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) App::abort(404);

        return View::make('user.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);
            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::PASSWORD_RESET:
                return Redirect::to('/');
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
        if (Auth::user()->check())
        {
            Session::flash('success', 'You are still login :)');
            return Redirect::to('user/account');
        }

        return View::make('user.login');
    }

    public function postLogin()
    {
        if (Auth::user()->check())
        {
            Session::flash('success', 'You are still login :)');
            return Redirect::to('user/account');
        }

        $rules = array(
            'email'     => array('required', 'email'),
            'password'  => array('required'),
        );

        $validation = Validator::make(Input::all(), $rules);

        if ( !$validation->fails() )
        {
            if (Auth::user()->attempt(array('email' => Input::get('email'), 'password' => Input::get('password'), 'status' => 1)))
            {
                // saving login ip and date
                $user = User::find(\Auth::user()->user()->id);
                $user->ip_login = Request::getClientIp();
                $user->save();

                return Redirect::intended('user/account');
            }
        }

        // Validation has failed.
        Session::flash('error', 'Incorrect email or password');
        return Redirect::to('user/login')->withInput()->withErrors($validation);
    }


    public function getAccount()
    {
        return View::make('user.account');
    }

    public function postAccount()
    {
        $rules = array(
            'nick'     => array('required', 'unique:users,nick,'.Auth::user()->user()->id),
        );

        $validation = Validator::make(Input::all(), $rules);

        if ( $validation->passes() )
        {
            $user = User::find(Auth::user()->user()->id);
            $user->nick = Input::get('nick');
            $user->save();

            // saving changes
            Session::flash('success', 'Data saved');
            return Redirect::to('user/account');
        }
        else
        {
            // Validation has failed.
            Session::flash('error', 'Incorrect email or password');
            return Redirect::to('user/account')->withInput()->withErrors($validation);
        }
    }

    public function getLogout()
    {
        Auth::user()->logout();

        Session::flash('success', 'Logout');
        return Redirect::to('/');
    }

}