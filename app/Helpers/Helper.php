<?php


/**
 * Write code on Method
 *
 * @return response()
 */

use Illuminate\Support\Facades\DB;

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
        return "Rp " . $formattedPrice;
    }
}

if (!function_exists("convertToWebp")) {
    function convertToWebp($inputFile, $outputFile)
    {
        $image = imagecreatefromstring(file_get_contents($inputFile));

        if ($image !== false) {
            $success = imagewebp($image, $outputFile, 80); // 80 adalah kualitas WebP, bisa disesuaikan
            imagedestroy($image);

            if ($success) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('checkRole')) {
    function checkRole($role)
    {
        $user =  DB::table('users')->where('id', auth()->user()->id)->first();
        switch ($user->role == $role) {
            case $role:
                return true;
            default:
                return false;
        }
    }
}

if (!function_exists('addClassToImg')) {
    function addClassToImg($matches)
    {
        $imgTag = $matches[0];
        $existingAttributes = $matches[1];
        // Tambahkan atribut class jika belum ada
        if (strpos($existingAttributes, 'class=') === false) {
            return str_replace('<img', '<img class="img-fluid rounded" width="100%" height="100%" ' . $existingAttributes, $imgTag);
        } else {
            return $imgTag; // Atribut class sudah ada, tidak perlu ditambahkan kembali
        }
    }
}
