<?php

namespace Vendor\Services\Exceptions;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Jun 15 2023 12:27:34 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Exceptions
 * @abstract Header Service Provider (HSP) Exceptions. 
 * Provides all Header service Exceptions 
 */
abstract class HeaderServiceExceptions extends Exceptions
{

    /**
     * #### Something Unexpected Happened
     * - This method throws an exception incase we encounter an error in the final result
     * @throws \ErrorException
     * @return void
     */
    protected static function somethingUnexpectedHappened()
    {
        return parent::errorException("Warning: Something unexpected happened");
    }
}