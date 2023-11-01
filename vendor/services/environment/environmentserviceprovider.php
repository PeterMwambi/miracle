<?php

namespace Vendor\Services\Environment;

use Vendor\Services\Environment\EnvironmentServiceConfiguration;
use Vendor\Services\File\File;

abstract class EnvironmentServiceProvider extends EnvironmentServiceConfiguration
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN LESP MODEL SERVICE METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Load Env variables in .env to system env
     * This is the heart of LESP. This method fetches environment variables set in the
     * .env file and loads them to the system environment 
     * Set environment variables from .env file
     * @return void
     */
    public function load()
    {
        if (!is_readable($this->getPath())) {
            return self::fileNotReadableException($this->getPath());
        }
        File::boot()->setFilePath($this->getPath());
        if (!File::boot()->verifyFileExists()) {
            return File::invalidFilePathException($this->getPath());
        }
        $lines = file($this->getPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), "#") === 0) {
                continue;
            }
            list($name, $value) = explode("=", $line, 2);
            $name = trim($name);
            $value = trim($value);
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf("%s=%s", $name, $value));
                $_ENV[$name] = $value;
            }
        }
    }
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END LESP MODEL SERVICE METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}