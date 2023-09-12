<?php

namespace App\Controllers;

use Vendor\Services\Configuration\Configuration;

class ConfigurationController extends Configuration
{
    public static function app(string $path)
    {
        return self::get("app", $path);
    }

    public static function server(string $path)
    {
        return self::get("server", $path);
    }
}