<?php

namespace Models\Core\App\Helpers;

final class Formatter extends DataTypes
{


    private static $_instance;

    public static function Run()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Formatter;
        }
        return self::$_instance;
    }

    public static function GetArrayKeys(array $array)
    {
        return array_keys($array);
    }


    public function FormatArray(array $array, array $keys)
    {
        return parent::RunArrayWriter($array, $keys);
    }

    public static function FormatToArray(mixed $data)
    {
        return ((array) $data);
    }

    public static function FormatToObject(array $array)
    {
        return ((object) $array);
    }
    public function FormatStringToArray(string $string, array $keys = [])
    {
        parent::SetString($string);
        return parent::RunFormatter($keys);
    }

    public function FormatStringToObject(string $string, array $keys)
    {
        parent::SetString($string);
        return ((object) parent::RunFormatter($keys));
    }
}