<?php

namespace Vendor\Services\Configuration;

use Vendor\Services\Exceptions\ConfigurationException;
use Vendor\Services\Hooks\Configuration;

/**
 * @author Peter Mwambi
 * @date Tue Aug 01 2023 17:34:32 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Configuration
 * @abstract Configuration Service Provider (CSP). This package loads configuration
 * services defined as constants and allows us fetch app configuration data as key value pairs.
 */
abstract class ConfigurationServiceSetup extends ConfigurationException
{

    /**
     * #### Configuration Constant Registrar
     * - This property stores the constant with configuration data that is being used.
     * @var array|string $constant - The configuration constant
     */
    private array|string $constant = [];


    /**
     * #### Configuration Constant File Path
     * - This property stores a file path to a configuration constant file
     * @var string $constantFilePath - The constant file path
     */
    private string $constantFilePath = "";


    /**
     * #### Configuration Constant FileHandler
     * - This property stores a configuration constant file handler
     * @var string $constantFileHandler - The constant file handler name
     */
    private string $constantFileHandler = "";

    /**
     * #### Configuration Constant Path Registrar
     * - This property stores the configuration constant path. Constant paths
     * are identified by array keys leading to a constant item.
     * @var array|string $constantPath - The constant path
     */
    private array|string $constantPath = "";


    /**
     * #### Configuration Constant Item Registrar
     * - This property stores the constant value called by the constant path.
     * the constant value is the value of the configuration array constant
     * @var array|string $constantItem - The constant item  
     */
    private array|string $constantItem = [];


    /**
     * #### Configuration Module Registrar
     * - This method stores a configuration module instance
     * @var Configuration $configurationModule - The configuration module
     */
    private Configuration $configurationModule;



    /**
     * #### Set Constant
     * - This method registers a constant to the configuration constant registrar
     * - Constants can be registered as constant names or constant definations 
     * @param array|string $constant - The defined constant
     * @return void
     */
    protected function setConstant(array|string $constant): void
    {
        $this->constant = $constant;
        return;
    }

    /**
     * #### Get Constant
     * - This method fetches a constant registered by configuration constant registrar
     * @return array|string - The defined constant name or its value
     */
    protected function getConstant(): array|string
    {
        return $this->constant;
    }

    /**
     * #### Set Constant File Path
     * - This method registers a file path to the constant file path registrar
     * - File paths contain links to configuration constant files
     * @param string $filePath - The constant file path
     * @return void
     */
    protected function setConstantFilePath(string $filePath): void
    {
        $this->constantFilePath = $filePath;
        return;
    }

    /**
     * #### Get Constant File Path
     * - This method fetches a constant file path from the constant file path registrar
     * @return string
     */
    protected function getConstantFilePath(): string
    {
        return $this->constantFilePath;
    }

    /**
     * #### Set Constant File Handler
     * - This method registers a constant file handler handler name to the constant file handler registrar
     * - Constant file handler names are short identification names with links to configuration files
     * @param string $fileHandler - The file handler name
     * @return void
     */
    protected function setConstantFileHandler(string $fileHandler): void
    {
        $this->constantFileHandler = $fileHandler;
        return;
    }

    /**
     * #### Get Constant File Handler
     * - This method fetches a constant file handler name from the constant file handler registrar
     * @return string - The constant file handler name
     */
    protected function getConstantFileHandler(): string
    {
        return $this->constantFileHandler;
    }

    /**
     * #### Set Constant Path
     * -This method registers a constant path to the constant path registrar
     * - Constant paths are array keys linking to configuration values stored in a configuration constant array
     * @param array|string $constantPath - The constant path
     * @return void
     */
    protected function setConstantPath(array|string $constantPath): void
    {
        $this->constantPath = $constantPath;
        return;
    }

    /**
     * #### Get Constant Path
     * - This method fetches a constant path from the constant path registrar
     * @return array|string - The constant path
     */
    protected function getConstantPath(): array|string
    {
        return $this->constantPath;
    }


    /**
     * #### Set Constant Item
     * - This method registers a constant item to the constant item registrar
     * - Constant items are array values stored in the configuration constant array
     * @return void
     */
    protected function setConstantItem(array|string $constantItem): void
    {
        $this->constantItem = $constantItem;
        return;
    }

    /**
     * #### Get Constant Item
     * -This method fetches a constant item from the constant item registrar 
     * @return array|string
     */
    protected function getConstantItem(): array|string
    {
        return $this->constantItem;
    }


    /**
     * #### Get Configuration Module
     * - This method gets a configuration module instance from the configuration module instance registrar
     * @return Configuration
     */
    protected function getConfigurationModule(): Configuration
    {
        return $this->configurationModule;
    }

    /**
     * #### Set Configuration Module
     * - This method registers a configuration module instance to the configuration module instance registrar
     * @param Configuration $configurationModule - The configuration module instance
     * @return self
     */
    protected function setConfigurationModule(Configuration $configurationModule): self
    {
        $this->configurationModule = $configurationModule;
        return $this;
    }
}