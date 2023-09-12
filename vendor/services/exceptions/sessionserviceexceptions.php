<?php

namespace Vendor\Services\Exceptions;

use Vendor\Services\Exceptions\Exceptions;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Sat Jun 03 2023 08:59:36 GMT+0300 (East Africa Time)
 * @package Vendor\Services\Exceptions
 * @version miracle v1.2.0
 * @abstract Session Service Provider (SSP) Exception handler.
 * Handles all session exceptions
 */
abstract class SessionServiceExceptions extends Exceptions
{
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN SESSION SERVICE EXCEPTION HANDLER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Session not started exception
     * - This method throws a runtime exception when we attempt to access a session variable in an unset session context
     * @throws \Vendor\Services\Helpers\Exceptions\Exceptions::runtimeException
     */
    protected function throwSessionNotStartedException()
    {
        return parent::runTimeException("Warning: No session has been started");
    }

    /**
     * #### Session name not found exception
     * - This method throws a runtime exception when we attempt to access an undefined session by name
     * @throws \RuntimeException 
     */
    protected function throwSessionNameNotFoundException(string $name)
    {
        return parent::invalidArgumentException(sprintf("Warning: Undefined session name %s ", $name));
    }


    /**
     * #### Session type invalid
     * - This method throws a runtime exception when we attempt to set a session of unknown type 
     */
    protected function throwSessionTypeInvalidException(string $type)
    {
        return parent::invalidArgumentException(sprintf("Warning: Invalid or missing session type %s", $type));
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SESSION SERVICE EXCEPTION HANDLER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}