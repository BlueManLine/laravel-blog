<?php

class IndexController extends BaseController
{

    public function getIndex()
	{
        $posts = Post::where('status', '=', 1)->take(15)->get();

        return View::make('index.hello')
            ->with('posts', $posts);
	}

}