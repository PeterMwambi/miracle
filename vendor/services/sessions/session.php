<?php

namespace Vendor\Services\Sessions;

use Vendor\Services\Sessions\SessionServiceProvider as BaseSSP;



/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Fri Jun 02 2023 14:00:14 GMT+0300 (East Africa Time)
 * @package Vendor\Services\Authentication\Sessions
 * @version miracle v1.2.0
 * @abstract Session Service Provider (SSP) Interface. 
 * Provides an interface to access session services
 */
final class Session extends BaseSSP
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN SSP SERVICE
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN BOOT SSP
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Boot SSP interface instance
     * - This method registers an instance of SSP interface to SSP instance registrar.
     * - This allows us to access SSP non static methods from static context.
     */
    public static function boot()
    {
        return BaseSSP::instance(new Session());
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END BOOT SSP
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN SSP GET METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Get all session names
     * - This method gets all session array keys which are the name pointers to defined sessions.
     * @return array
     */
    public function getSessionNames()
    {
        self::start();
        return parent::getAllRegisteredSessionNames();
    }

    /**
     * #### Get all sessions
     * This method returns an array of all defined sessions
     * @return array
     */
    public function getAllSessions()
    {
        self::start();
        return parent::getAllRegisteredSessions();
    }

    /**
     * #### Get session handler by name
     * - This method gets a session handler value, identified by the session name
     * @return string|array
     */
    public static function getHandlers(string $name, string $handler)
    {
        return self::boot()->getSessionServiceHandlers($name, $handler);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SSP GET METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SSP SERVICE
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */



}