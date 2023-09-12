<?php

namespace Vendor\Services\Server;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Wed Aug 09 2023 15:51:25 GMT+0300 (East Africa Time)
 * @version Miracle v1.2.0
 * @package Vendor\Services\Server
 * @abstract Server Service Provider (SSP). Provide Server Access Methods
 */


abstract class ServerServiceProvider extends ServerServiceConfiguration
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | GENERATE SERVER RESPONSE CODES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /**
     * Throw a 400 server response
     * @return int|bool
     */
    public function throw400Error()
    {
        return Server::httpResponseCode(400);
    }


    /**
     * Throw a 401 server response
     * @return int|bool
     */
    public function throw401Error()
    {
        return Server::httpResponseCode(401);
    }

    /**
     * Throw a 402 server response
     * @return int|bool 
     */
    public function throw402Error()
    {
        return Server::httpResponseCode(402);
    }

    /**
     * Throw a 404 server response code
     * @return int|bool
     */
    public function throw404Error()
    {
        return Server::httpResponseCode(404);
    }

    /**
     * Throw a 500 server response code
     * @return int|bool
     */
    public function throw500Error()
    {
        return Server::httpResponseCode(500);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END GENERATE SERVER RESPONSE CODE
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | DEFINE SERVER VARIABLES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Get the client request protocol
     * This method checks the protocol client traffic is listening to
     * Protocols are http or https
     * @return string
     */
    protected function requestProtocol()
    {
        return Server::get("request/scheme");
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END DEFINE SERVER VARIABLES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN SERVER VERIFICATION METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * Verify request protocol is HTTPS.
     * This method checks if a request resources listens on HTTPS traffic
     * @return bool
     */
    public function verifyProtocolIsHTTPS()
    {
        if ($this->requestProtocol() === "https") {
            return true;
        }
        return false;
    }

    /**
     * Verify response code is 200
     * This method checks if the server request method is has been completed
     * successfuly with a response code of 200
     */
    public function verify200ResponseCode()
    {
        if (Server::httpResponseCode() === 200) {
            return true;
        }
        return false;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SERVER VERIFICATION METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SERVER CONFIGURATION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}