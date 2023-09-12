<?php

namespace Vendor\Services\Hooks;

use Vendor\Services\Data\Data;
use Vendor\Services\Exceptions\ConfigurationException;
use Vendor\Services\File\File;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Fri Sep 01 2023 11:21:21 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Modules
 * @abstract JSON Configuration Formatter - Formats Configuration Data specified in config.json file to a parsable readable format
 */
class Configuration extends ConfigurationException
{

    /**
     * #### Config File Path Registrar
     * - This property stores a file path to the `config.json` file
     * @var string $configFilePath - The config file path
     */
    private string $configFilePath;

    /**
     * #### Config Items Registrar
     * - This property stores file items found in `config.json` file
     * @var array|object $configFileItems - The config file items 
     */
    private array|object $configFileItems;

    /**
     * #### Config Item Key Registrar
     * - This property stores a configuration item key
     * @var string $key - The configuration item key
     */
    private string $configKey = "";


    /**
     * #### Config Item Registrar
     * - This property stores a configuration item value
     * @var array|object|string - The configuration item value
     */
    private array|object|string $configItem = "";


    /**
     * #### Get Config File Path
     * - This method gets a registered file path from the config file path registrar
     * @return string
     */
    private function getConfigFilePath(): string
    {
        return $this->configFilePath;
    }

    /**
     * #### Set Config File path
     * - This method registers a config file path to the config file path registrar
     * @param string $configFilePath - The config file path
     * @return self
     */
    private function setConfigFilePath(string $configFilePath): self
    {
        $this->configFilePath = $configFilePath;
        return $this;
    }

    /**
     * #### Get Config File Items
     * - This method gets registered config file items from the config file items registrar 
     * @return array|object
     */
    private function getConfigFileItems(): array|object
    {
        return $this->configFileItems;
    }

    /**
     * #### Set Config File Items
     * - This method gets registered config file items from the config file items registrar
     * @param array|object $configFileItems - The config file items
     * @return self
     */
    private function setConfigFileItems(array|object $configFileItems): self
    {
        $this->configFileItems = $configFileItems;
        return $this;
    }

    /**
     * #### Config Item Key Registrar
     * - This method gets a configuration item key from the configuration item key registrar
     * @return string
     */
    private function getConfigKey(): string
    {
        return $this->configKey;
    }

    /**
     * #### Set Config Key
     * - This method registers a configuration item key to the configuration item key registrar
     * @param string $configKey - The configuration item key
     * @return self
     */
    private function setConfigKey(string $configKey): self
    {
        $this->configKey = $configKey;
        return $this;
    }

    /**
     * #### Config Item Registrar
     * - This method gets a configuration item value from the configuration item value registrar
     * @return array|object|string
     */
    private function getConfigItem(): array|object|string
    {
        return $this->configItem;
    }

    /**
     * #### Set Config Item
     * - This method registers the configuration item value to the configuration item value registrar
     * @param array|object|string $configItem - The  configuration item value 
     * @return self
     */
    private function setConfigItem(array|object|string $configItem): self
    {
        $this->configItem = $configItem;
        return $this;
    }


    /**
     * #### __constructor()
     * - This method gets a path to a configuration file and allows us to fetch configuration file items 
     * @param string $path - The file path to a configuration constant
     * @return void
     */
    public function __construct(string $path = null)
    {
        (!isset($path)) ? $this->setConfigFilePath("app/config/config.json") : $this->setConfigFilePath($path);
        $this->setConfigFileItems(Data::jsonDecode(File::getContents($this->getConfigFilePath())));
    }


    /**
     * #### Get Item
     * - This method gets a configuration file item identified by its key and name identifier from the configuration file items
     * - The method throws an exception in case an encountered key or name is invalid or does not exist in the configuration file
     * @return string|false 
     */
    private function getItem()
    {
        $key = $this->getConfigKey();
        $item = $this->getConfigItem();
        if (Data::propertyExists($this->getConfigFileItems(), $key)) {
            if (Data::propertyExists($this->getConfigFileItems()->$key, $item)) {
                return $this->getConfigFileItems()->$key->$item;
            } else {
                parent::wrongConfigurationKeyException($this->getConfigItem());
                return false;
            }
        } else {
            parent::wrongConfigurationKeyException($this->getConfigKey());
            return false;
        }
    }

    /**
     * #### Get Constant
     * - This method gets a configuration constant name from a configuration file
     * - The constant name is identified by the alias `name` found as a key on the configuration file.
     * @return string|false
     */
    public function getConstant(string $key)
    {
        $this->setConfigKey($key);
        $this->setConfigItem("name");
        return $this->getItem();
    }

    /**
     * #### Get Constant Path
     * - This method gets a constant file path from the configuration file
     * - The constant file path is identified by the alias `path` found as a key on the configuration file
     * @return string|false 
     */
    public function getPath(string $key)
    {
        $this->setConfigKey($key);
        $this->setConfigItem("path");
        return $this->getItem();
    }


}