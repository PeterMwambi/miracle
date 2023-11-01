<?php

namespace Vendor\Services\Routes;

use Vendor\Services\Server\Server;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Tue May 30 2023 21:51:20 GMT+0300 (East Africa Time)
 * @package Vendor\Services\Routes
 * @version miracle v1.2.0
 * @abstract Route Service Provider(RSP) Interface Provider. 
 * Handles all route services 
 */
class Route extends RouteServiceProvider
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN RSP (RSP) INTERFACE SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN RSP REQUEST METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Get Requests
     * - This method handles all GET requests. 
     * #### Note: This method handles only GET requests 
     * @param string $route - The URI request handler 
     * @param callable $callback - A callable that fires when route is called by client browser
     * @return bool
     */
    public final static function get(string $route, callable $callback)
    {
        if (Server::get("request/method") === "GET") {
            return self::boot()->runGetService($route, $callback);
        }
        return false;
    }

    /**
     * #### Post Requests
     * - This method handles all post requests.
     * #### Note: This method handles only POST requests
     * @param string $route - The URI request handler
     * @param callable $callback - A callable that fires when route is called by client browser
     * @return bool
     */
    public final static function post(string $route, callable $callback)
    {
        if (Server::get("request/method") === "POST") {
            return self::boot()->runPostService($route, $callback);
        }
        return false;
    }


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END RSP REQUEST METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END (RSP) INTERFACE SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}