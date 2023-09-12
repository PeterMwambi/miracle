<?php

namespace Vendor\Services\Exceptions;

use ErrorException;
use Exception;
use InvalidArgumentException;
use RuntimeException;


/**
 * @author Peter Mwambi
 * @date Tue May 30 2023 20:39:08 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Base Exceptions Handler Service Provider(BEHSP). Defines a base class that handles
 * all exceptions during service processes 
 */
abstract class Exceptions extends Exception
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN BASE EXCEPTION HANDLER SERVICE PROVIDER (BEHSP)
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * Throw an error execption
     * @param string $message
     * @throws ErrorException
     */
    public static function errorException(string $message)
    {
        throw new ErrorException($message);
    }
    /**
     * Throw an invalid argument exception
     * @param string $message
     * @throws InvalidArgumentException
     */
    public static function invalidArgumentException(string $message)
    {
        throw new InvalidArgumentException($message);
    }

    /**
     * Throws a runtime exception
     * @param string $message
     * @throws RuntimeException
     */
    public static function runTimeException(string $message)
    {
        throw new RuntimeException($message);
    }
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END BASE EXCEPTION HANDLER SERVICE PROVIDER (BEHSP)
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}