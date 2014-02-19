<?php

namespace Admin;

class UsersController extends BaseController
{

    public function getIndex()
    {
        $this->setTitle('List of registered users');

        $users = \User::all();

        return \View::make('admin.users.index')
            ->with('users', $users);
    }

    public function getStatus($user_id)
    {
        $user = \User::find($user_id);

        if( !is_null($user) )
        {
            // ok - model loaded
            $user->status = $user->status==\User::status_active ? \User::status_banned : \User::status_active;
            $user->save();

            \Session::flash('success', 'Status changed');
        }
        else
        {
            \Session::flash('error', 'Unknown usre ID');
        }

        return \Redirect::to('admin/users');
    }

    public function getCreate()
    {
        $this->setTitle('Add new user');

        return \View::make('admin/users/create');
    }

    public function postCreate()
    {
        $rules = \User::$rules;
        $rules['password'] = 'required|min:3';
        $rules['status'] = 'required';
        $validator = \Validator::make(\Input::all(), $rules);

        if ( $validator->passes() )
        {
            $user = new \User();
            $user->status = \Input::get('status');
            $user->email = \Input::get('email');
            $user->password = \Hash::make(\Input::get('password'));
            $user->ip_created = \Request::getClientIp();
            $created = $user->save();

            if( $created===true )
            {
                \Session::flash('success', 'Nice, user added!');
                return \Redirect::to('admin/users');
            }
        }

        // Validation has failed.
        \Session::flash('error', 'Please complete correctly all fields');
        return \Redirect::to('admin/users/create')->withInput()->withErrors($validator);
    }

}
