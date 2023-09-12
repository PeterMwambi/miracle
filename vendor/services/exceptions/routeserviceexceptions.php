<?php

namespace Vendor\Services\Exceptions;


/**
 * @author Peter Mwambi
 * @date Thu Jun 15 2023 12:05:21 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Exceptions
 * @abstract Route Service Provider (RSP) Exception handler.
 * Handles all route exceptions 
 */
abstract class RouteServiceExceptions extends Exceptions
{

    protected static function invalidRouteException(string $route)
    {
        return parent::runTimeException(sprintf("Warning: Could not get route contents for: %s", $route));
    }

}