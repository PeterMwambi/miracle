<?php

namespace Vendor\Services\Exceptions;

use Vendor\Services\Exceptions\Exceptions;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Sat Jun 03 2023 21:34:35 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Exceptions
 * @abstract Token Service Provider (TSP) Exceptions. Handles all token service exceptions
 */
abstract class TokenServiceExceptions extends Exceptions
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN TOKEN EXCEPTION SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Token Verification Failed Exception 
     * - This method throws an exception when we encounter an invalid token 
     * @throws \ErrorException
     */
    protected static function throwNewTokenVerificationFailed()
    {
        return parent::errorException("Warning: Token verification failed");
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END TOKEN EXCEPTION SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}