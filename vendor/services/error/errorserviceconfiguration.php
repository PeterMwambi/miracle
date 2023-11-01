<?php


namespace Vendor\Services\Error;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Sep 28 2023 04:57:07 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Sevices\Error
 * @abstract Error Reporting Service Provider. Contains all error handling and error reporting methods
 */
abstract class ErrorServiceConfiguration extends \Error
{
    /**
     * #### Error Level Registrar
     * - This property registers an error Level e.g E_ALL, E_COMPILE, E_NOTICE
     * @var int|null $errorLevel - The error level to be registered
     */
    private int|null $errorLevel;

    /**
     * #### Environment Registrar
     * - This property stores the value of the environment we are working on
     * - Environments can either be `production` or `development` environments 
     */
    private string $environment = "";

    /**
     * #### Get current environment
     * - This method gets the current registered environment from Environment registrar
     * @return string
     */
    protected function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * #### Set current environment
     * - This property registers the set environment value to the environment registrar
     * - The environment is configured in the `.env` file 
     * @param string $environment - The registered environment
     * @return self
     */
    protected function setEnvironment(string $environment): self
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * #### Get Error Level
     * - This method gets a registered error level from `Error level registrar`
     * @return int|null
     */
    protected function getErrorLevel(): int|null
    {
        return $this->errorLevel;
    }

    /**
     * #### Set Error Level
     * - This method registers an error level to the `Error level registrar`
     * @param int|null $errorlevel - The registered error level
     * @return self
     */
    protected function setErrorLevel(int|null $errorLevel): self
    {
        $this->errorLevel = $errorLevel;
        return $this;
    }

    /**
     * #### Set Error Reporting
     * - This method registers an error reporting level
     * @return int
     */
    protected function setErrorReporting(int|null $errorType)
    {
        return error_reporting($errorType);
    }
}