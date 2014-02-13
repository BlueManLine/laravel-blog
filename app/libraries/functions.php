<?php

// magic_quotes_gpc - This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

/**
 * var_dump() function with die; on exit
 */
function die_dump()
{
    call_user_func_array('var_dump',func_get_args());
    die;
}


/**
 * echo's string with die; on exit
 */
function die_echo()
{
    foreach(func_get_args() as $val) {
        if( !is_object($val) && !is_array($val) ) {
            echo $val;
        }
    }
    die;
}
