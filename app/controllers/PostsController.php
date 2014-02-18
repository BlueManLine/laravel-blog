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

}