<?php

namespace helpers;

class Form
{

    public static function errors($message)
    {
        if( is_null($message) || empty($message) )
        {
            return '';
        }

        return '<span class="text-danger">'.$message.'</span>';
    }

}
