<?php

class HomeController extends BaseController {

    //protected $layout = 'layouts.master';

    public function getIndex()
	{
        return View::make('hello');
        //$this->layout->content = 'adfdafad';
	}

}