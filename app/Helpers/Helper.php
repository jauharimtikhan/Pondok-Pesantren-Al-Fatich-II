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
