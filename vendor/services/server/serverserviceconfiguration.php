<?php


namespace Vendor\Services\Server;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Wed Aug 02 2023 15:54:52 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Server Service Provider (SSP). Provides all server services
 */
abstract class ServerServiceConfiguration
{

    /**
     * #### Server Instance Registrar
     * - This property stores an instance of the Server class
     * and allows us to access non static server methods from static context
     * @var Server $instance 
     */
    private static $instance;

    /**
     * #### Get Server Instance
     * - This method gets a server instance and allows us to access non static
     * server methods from static context
     * @return Server
     */
    public static function get()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Server();
        }
        return self::$instance;
    }


}