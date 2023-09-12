<?php

namespace Vendor\Services\Configuration;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Tue Aug 01 2023 20:51:08 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Configuration
 * @abstract Configuration Service Provider (CSP). This package loads configuration
 * services defined as constants and allows us fetch app configuration data as key value pairs.
 */
class Configuration extends ConfigurationServiceProvider
{
    /**
     * #### Get Configuration Data
     * - This method binds together all methods and allow us to access configuration
     * constant data from configuration files.
     * @param string $name - An alias name to a configuration file
     * @param $path - A path that links to a configuration file data item
     */
    public static function get(string $name, string $path = "")
    {
        return (new Configuration($name, $path))->runServiceSetup();
    }


    /**
     * #### Get App Cofiguration data
     * - This method fetches app configuration data from app configuration constants
     * @param string $path - An array path to the configuration data
     * @return array|string - The retrieved configuration data
     */
    public static function app(string $path)
    {
        return self::get("app", $path);
    }

}