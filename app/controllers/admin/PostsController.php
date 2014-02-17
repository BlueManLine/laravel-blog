<?php

namespace Admin;

class PostsController extends BaseController
{

    public function getCreate()
	{
        $this->setTitle('Create new post');

        return \View::make('admin/posts/create');
	}

    public function postCreate()
    {
        $validator = \Validator::make(\Input::all(), \Post::$rules);

        if ( $validator->passes() )
        {
            $post = new \Post();
            $record = $post->savePost(\Input::all());

            if( $record===true )
            {
                \Session::flash('success', 'Nice, post added!');
                return \Redirect::to('admin/posts');
            }
        }

        // Validation has failed.
        \Session::flash('error', 'Please complete correctly all fields');
        return \Redirect::to('admin/posts/create')->withInput()->withErrors($validator);
    }

    public function getIndex()
    {
        $this->setTitle('List of posts');

        $posts = \Post::with('admin')->get();

        return \View::make('admin.posts.index')
            ->with('posts', $posts);
    }

    public function getVisibility($post_id)
    {
        $post = \Post::find($post_id);

        if( !is_null($post) )
        {
            // ok - model loaded
            $post->status = $post->status==1 ? 0 : 1;
            $post->save();

            \Session::flash('success', 'Visiblity changed');
        }
        else
        {
            \Session::flash('error', 'Unknown post ID');
        }

        return \Redirect::to('admin/posts');
    }

}
