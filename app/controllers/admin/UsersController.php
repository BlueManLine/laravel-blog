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
            $user->status = $user->status==1 ? 0 : 1;
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
