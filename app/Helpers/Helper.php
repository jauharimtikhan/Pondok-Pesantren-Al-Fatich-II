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
        $pos = strrpos($string, ',');
        if ($pos !== false) {
            $string = substr($string, 0, $pos + 4);
        }

        return  preg_replace('/[^0-9]/', '', $string);
    }
}

if (!function_exists('convertRp')) {
    function convertRp($string)
    {
        $number = intval($string);
        $formattedPrice = number_format($number, 2, ',', '.');
        return "Rp" . $formattedPrice;
    }
}
