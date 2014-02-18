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
            $comment = new Comment(array('body' => Input::get('text')));
            $commented = $record->comments()->save($comment);
        }

        return Redirect::to(Request::url());
    }

}