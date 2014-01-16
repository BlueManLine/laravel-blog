<?php
namespace Helpers;


class MrView
{
    public static function activeLaravelLink($sLink, $sMatchReturn=' active')
    {
        $sControllerAction = \Route::getCurrentRoute()->getActionName();

        $sReturn = '';

        if( $sLink==$sControllerAction )
        {
            $sReturn = $sMatchReturn;
        }

        return $sReturn;
    }
}