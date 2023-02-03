<?php
namespace Models\Auth;

/**
 * @author Peter Mwambi
 * @content Sanitize library
 * @time Sun Nov 22 2020 14:37:18 GMT+0300 (East Africa Time)
 * @updated Mon Sep 19 2022 09:47:40 GMT+0300 (East Africa Time)
 * 
 * Contains static methods to filter form input
 */

class Sanitize
{

    public static function String($data)
    {
        $data = filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
        return $data;
    }
    public static function Int($data)
    {
        $data = filter_var($data, FILTER_VALIDATE_INT);
        return $data;
    }
    public static function Bool($data)
    {
        $data = filter_var($data, FILTER_VALIDATE_BOOLEAN);
        return $data;
    }
    public static function Email($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return $email;
    }
}