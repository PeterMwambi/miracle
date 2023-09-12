<?php

namespace Vendor\Services\Environment;

use Vendor\Services\Core\FileAccess;
use Vendor\Services\Exceptions\EnvironmentExceptions;
use Vendor\Services\File\File;

/**
 * @author Peter Mwambi
 * @date Thu Apr 27 2023 18:40:36 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Load Env Service Provider (LESP). LESP Model Provider.
 * Abstracts LESP Interface Provider
 */
abstract class EnvironmentServiceConfiguration extends EnvironmentExceptions
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN LESP MODEL PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * LESP model service registrar
     * This property stores an instance of LESP Interface service (LoadDotEnv::class) 
     */
    private static $instance;

    /**
     * LESP model path registrar
     * This property stores the path to the dot env file 
     * @var string
     */
    protected $path = "";

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BOOT LESP MODEL
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * Register LESP interface service
     * This method registers an instance of LESP Interface service to LESP Model Service Registrar
     * @param object $instance
     * @return object|null 
     */
    protected static function getInstance(object $instance)
    {
        if (!isset(self::$instance)) {
            self::$instance = $instance;
        }
        return self::$instance;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END BOOT LESP MODEL
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN LESP MODEL GETTERS AND SETTERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Get path from LESP path registrar
     * This property returns the configured path stored in LESP path registrar 
     * @return string
     */
    protected function getPath()
    {
        return $this->path;
    }

    /**
     * Register path to LESP path registrar
     * This method registers a file path to LESP path registrar.
     * @param string $path The directory where the .env file is located
     * @return self
     */
    protected function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END LESP MODEL GETTERS AND SETTERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END LESP MODEL VERIFICATION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */



    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END LESP MODEL PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}