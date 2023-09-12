<?php

namespace Vendor\Services\Environment;

use Vendor\Services\Environment\EnvironmentServiceProvider;
use Vendor\Services\File\File;


/**
 * @author Peter Mwambi
 * @date Thu Apr 27 2023 18:40:36 GMT+0300 (East Africa Time)
 * @abstract Load Env Service Provider (LESP). LESP Interface Provider.
 * Loads user defined environment variable values by name
 */
final class Environment extends EnvironmentServiceProvider
{
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN LOAD DOT ENV SERVICE PROVIDER (LESP)
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BOOT LESP SERVICE
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * Begin load env service
     * This method instantiates LoadDotEnv::class and begins the load Env Service
     * @return Environment
     */
    public static function boot()
    {
        return parent::getInstance(new Environment());
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END BOOT LESP SERVICE
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN LESP SERVICE METHODS 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Get environment variable by value
     * This method wraps up Load Env Service Provider. 
     * It fetches the .env file from the root directory and attempts
     * to load variable values in the file. If the key passed to its
     * first argument exists, it returns the key value. 
     * @param string - The environment variable
     * @return string|void
     */
    public static function get(string $var)
    {
        self::boot()->setPath(File::boot()->getRootDirPath() . "/.env");
        self::boot()->load();
        if (self::boot()->verifyEnvVariable($var)) {
            return getEnv($var);
        }
        return;
    }

    /**
     * Verify environment variable
     * This method verifies if an environment variable passes to 
     * LoadDotEnv::get() exists in .env file. If no such variable
     * is defined it fires an EnvVariableNotFound exception
     * @param string $var - The env variable for search
     * @return bool|void
     * @throws \InvalidArgumentException
     */
    public function verifyEnvVariable(string $var)
    {
        if (getEnv($var)) {
            return true;
        }
        return self::envVariableNotFound($var);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END LESP SERVICE METHODS 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END LOAD DOT ENV SERVICE PROVIDER (LESP)
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}