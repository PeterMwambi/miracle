<?php

namespace App\Controllers;

use Vendor\Services\Configuration\Configuration;

class ConfigurationController extends Configuration
{
    public static function app(string $target)
    {
        return self::get("app", $target);
    }

    public static function server(string $target)
    {
        return self::get("server", $target);
    }

    public static function rules(string $target = "")
    {
        return self::get("rules", $target);
    }

    public static function errors(string $target = "")
    {
        return self::get("errors", $target);
    }
}