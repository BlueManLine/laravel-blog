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

    }

}
