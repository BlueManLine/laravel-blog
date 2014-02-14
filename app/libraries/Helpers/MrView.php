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
     * @uses  Helpers\MrView::activeLaravelLink('UserController@getRegister')
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

    /**
     * Get an object with names of elements: namespace, controller, action and method
     *
     * @param null|string $type
     *
     * @return null|\stdClass
     */
    public static function getControllerAction($type=null)
    {
        $sModuleControllerAction = \Route::getCurrentRoute()->getActionName();

        preg_match('/(.*\\\)?(.*)Controller@(get|post|put|delete|patch)(.*)/', $sModuleControllerAction, $matches);

        $namespace = substr($matches[1],-1)=='\\' ? substr($matches[1],0,-1) : $matches[1];

        $pathParam = new \stdClass();
        $pathParam->namespace = strtolower($namespace);
        $pathParam->controller = strtolower($matches[2]);
        $pathParam->action = strtolower($matches[4]);
        $pathParam->method = strtolower($matches[3]);

        if( is_null($type) )
        {
            return $pathParam;
        }
        elseif( is_string($type) && property_exists($pathParam, $type) )
        {
            return $pathParam->{$type};
        }

        return null;
    }
}
