<?php

class IndexController extends BaseController
{

    public function getIndex()
	{
        $posts = Post::where('status', '=', 1)->orderBy('id','DESC')->paginate(15);

        return View::make('index.index')
            ->with('posts', $posts);
	}

}