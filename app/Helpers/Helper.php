<?php


/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('Logged')) {
    function Logged()
    {
        $session = session()->get('user');
        if ($session) {
            return $session;
        }
    }
}

if (!function_exists('RP')) {
    function RP($string)
    {
        return  preg_replace('/[^0-9]/', '', $string);
    }
}
