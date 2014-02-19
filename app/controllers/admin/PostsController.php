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

    public function getEdit($post_id)
    {
        $this->setTitle('Edit a post');

        $post = \Post::find($post_id);

        if( !is_null($post) )
        {
            // ok - model loaded

            return \View::make('admin.posts.edit')
                ->with('post', $post);
        }
        else
        {
            \Session::flash('error', 'Unknown post ID');
        }

        return \Redirect::to('admin/posts');
    }

    public function postEdit($post_id)
    {
        $post = \Post::find($post_id);

        if( !is_null($post) )
        {
            $rules = \Post::$rules;
            $rules['title'] = 'required|unique:posts,title,'.$post_id;

            $validator = \Validator::make(\Input::all(), $rules);

            if ( $validator->passes() )
            {
                $record = $post->savePost(\Input::all());

                if( $record===true )
                {
                    \Session::flash('success', 'Nice, post changed!');
                    return \Redirect::to('admin/posts');
                }
            }

            // Validation has failed.
            \Session::flash('error', 'Please complete correctly all fields');
            return \Redirect::to('admin/posts/edit/'.$post_id)->withInput()->withErrors($validator);
        }
        else
        {
            \Session::flash('error', 'Unknown post ID');
        }

        return \Redirect::to('admin/posts');
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
