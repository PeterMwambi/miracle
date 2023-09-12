<?php

namespace Vendor\Services\Server;

use Vendor\Services\Configuration\Configuration;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Wed Aug 02 2023 15:54:52 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Server Service Provider (SSP). Provides all server services
 */
class Server extends ServerServiceProvider
{
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN SERVER CONFIGURATION 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BOOT SERVER CONFIGURATION METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */




    /**
     * Fetch server configuration settings from defined key
     * This method returns a specified key that has been set in the config/server file
     * e.g self::get("request/scheme")
     * @param string|null $key
     * @return string|array|Server
     */
    public static function get(string $path = "")
    {
        if (!empty($path)) {
            return Configuration::get("server", $path);
        } else {
            return parent::get();
        }
    }

    /**
     * Generates a custom server response code
     * This method generates a customised server response code
     * @param int $code custom response code
     * @return int|bool
     */
    public static function httpResponseCode(int $code = 0)
    {
        return http_response_code($code);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END BOOT SERVER CONFIGURATION METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}