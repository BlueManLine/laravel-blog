<?php

class PostsController extends BaseController
{

    public function getIndex()
	{

	}

    public function showBySlug($slug)
    {
        $record = Post::where('slug', '=', $slug)->first();

        return View::make('posts.show-by-slug')
            ->with('record', $record);
    }

    public function saveComment($slug)
    {
        $record = Post::where('slug', '=', $slug)->first();

        if( !is_null($record) )
        {
            $rules = array(
                'text'     => array('required', 'min:2'),
            );

            $validation = \Validator::make(\Input::all(), $rules);

            if ( $validation->passes() )
            {
                $comment = new Comment(array('body' => Input::get('text')));
                $commented = $record->comments()->save($comment);

                Session::flash('success', 'Comment add');
            }
            else
            {
                Session::flash('error', 'Please fill the comment field');
            }
        }
        else
        {
            Session::flash('error', 'The post doesnt exists.');
        }

        return Redirect::to(Request::url());
    }

}