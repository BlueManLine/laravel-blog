<?php

namespace Admin;

class BaseController extends \Controller
{

    public function setTitle($sTitle)
    {
        \View::share('page_title', $sTitle);
    }


}