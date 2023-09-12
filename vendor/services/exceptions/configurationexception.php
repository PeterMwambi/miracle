<?php

namespace Vendor\Services\Exceptions;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Fri May 26 2023 14:34:18 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Exceptions
 * @abstract The BaseConfigurationException. Handles all Base Configuration Service Provider (BCSP)
 * exceptions
 */
abstract class ConfigurationException extends Exceptions
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN BASE CONFIGURATION EXCEPTION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Throw an errorException when in case of an invalid constant
     * This method fires an exception when an invalid constant is prexented to the CSP registrar
     * @param $constant
     * @throws \ErrorException;
     */
    public function wrongConstantException(string $constant)
    {
        return self::errorException(sprintf("Warning: Call to an undefined constant: %s", $constant));
    }

    /**
     * Throw an invalidArgumentException in case of an invalid constant key
     * This method fires an exception when an invalid path map value is presented to the BCSP fetch() method
     * @param $key
     * @throws \InvalidArgumentException
     */
    public function wrongConfigurationKeyException(string $key)
    {
        return self::invalidArgumentException(sprintf("Invalid key: %s", $key));
    }

    /**
     * Throw an invalidArgumentException in case of an invalid parent and child key
     * This method fires an exception when an invalid key is presented to the BSCP verify() method 
     * @throws \InvalidArgumentException
     */
    public function wrongParentAndChildKeyException()
    {
        return self::invalidArgumentException(sprintf("Warning invalid key or value detected on line %s", $this->getLine()));
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END BASE CONFIGURATION EXCEPTION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}