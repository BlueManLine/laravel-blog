<?php
namespace Helpers;


class MrView
{
    /**
     * Returning an string represent (un)active state of a link/resource
     *
     * @param string    $sLink          a link in SomeController@getAction statement for specify RESTful actions or SomeController@*Action for all RESTful actions
     * @param string    $sMatchReturn   OPTIONAL: a text to return on success match
     *
     * @usage Helpers\MrView::activeLaravelLink('UserController@getRegister')
     *        Helpers\MrView::activeLaravelLink('UserController@*Register')
     *        Helpers\MrView::activeLaravelLink('UserController@getRegister', ' selected')
     *
     * @return string
     */
    public static function activeLaravelLink($sLink, $sMatchReturn=' active')
    {
        $sControllerAction = \Route::getCurrentRoute()->getActionName();

        $sReturn = '';

        if( str_contains($sLink,'@*') )
        {
            // ::get, ::post, ::put, ::delete, ::patch
            $sControllerAction = str_replace(array('@get', '@post', '@put', '@delete', '@patch'), '@*', $sControllerAction);
        }

        if( $sLink==$sControllerAction )
        {
            $sReturn = $sMatchReturn;
        }

        return $sReturn;
    }
}
