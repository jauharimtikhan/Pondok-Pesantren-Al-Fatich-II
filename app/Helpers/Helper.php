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
        $angka = str_replace(["Rp. ", ".", ','], "", $string);

        return  intval($angka);
    }
}

if (!function_exists('convertRp')) {
    function convertRp($string)
    {
        return number_format($string, 0, ',', '.');
    }
}
