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

}
