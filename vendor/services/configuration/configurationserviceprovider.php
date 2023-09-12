<?php

namespace Vendor\Services\Configuration;

use Vendor\Services\File\File;
use Vendor\Services\Hooks\Configuration;

/**
 * @author Peter Mwambi
 * @date Tue Aug 01 2023 22:49:08 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Configuration
 * @abstract Configuration Service Provider (CSP). This package loads configuration
 * services defined as constants and allows us fetch app configuration data as key value pairs.
 * @todo Allow configurations to be drawn from both php files and json files
 */
abstract class ConfigurationServiceProvider extends ConfigurationServiceSetup
{

    /**
     * #### Construct
     * - The constructor method gets a file handler from client code which will be used to 
     * access configuration file data
     * @param string fileHandler - The configuration file name identifier
     * @return void;
     */
    public function __construct(string $fileHandler, string $path = "")
    {
        $this->setConstantFileHandler($fileHandler);
        $this->setConfigurationModule(new Configuration);
        $this->setConstantPath($path);
        $this->runServiceSetup();
    }

    /**
     * #### Run Service Setup
     * - This method wraps together all other methods that will be required to access configuration
     * constant data
     * @return array|string - The configuration constant item; 
     */
    public function runServiceSetup(): array|string
    {
        $this->getConstantFile();
        $this->getConstantFromName();
        $this->formatConstantPathToArray();
        $this->getConfigurationItem();
        return $this->getConstantItem();
    }

    /**
     * #### Get Constant File
     * - This method calls a constant file identified by its file path in `.package.registrar.php`
     * @return void
     */
    private function getConstantFile(): void
    {
        $this->setConstantFilePath($this->getConfigurationModule()->getPath($this->getConstantFileHandler()));
        File::require($this->getConstantFilePath());
        return;
    }



    /**
     * #### Format Constant Path
     * - This method formats a constant path registered in the constant path registrar, into an array
     * - The values of the array will be used as keys to access configuration constant data
     * @return bool
     */
    private function formatConstantPathToArray(): bool
    {
        if (is_string($this->getConstantPath()) && !empty($this->getConstantPath())) {
            $this->setConstantPath(explode("/", $this->getConstantPath()));
            return true;
        }
        return false;
    }

    /**
     * #### Verify Constant
     * - This method verifies if a set constant has been defined
     * @return bool - `true` if constant has been defined otherwise `false`
     */
    private function verifyConstant()
    {
        if (defined($this->getConstant())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * #### Get Constant From Name
     * - This method gets a constant value from its name defination.
     * @return bool - `true` if constant name is valid otherwise `false`;
     */
    private function getConstantFromName(): bool
    {
        $this->setConstant($this->getConfigurationModule()->getConstant($this->getConstantFileHandler()));
        if ($this->verifyConstant()) {
            $this->setConstant(constant($this->getConstant()));
            return true;
        } else {
            $this->wrongConstantException($this->getConstant());
            return false;
        }

    }


    /**
     * #### Get Configuration Item
     * - This method gets a configuration item from a defined configuration constant
     * - Regardless of whether a constant path has been configured or not, the method 
     * registers configuration constant items to the configuration constant item registrar.
     * @return bool
     */
    private function getConfigurationItem(): bool
    {
        if (is_array($this->getConstantPath())) {
            return $this->getConfigurationItemsFromPath();
        } else {
            $this->setConstantItem($this->getConstant());
            return false;
        }
    }


    /**
     * #### Get Configurtion Item From path
     * - This method gets a configuration item from a defined configuration constant
     * - The method checks the constant path entries supplied by client code and binds the to the
     *    configuration constant array
     * @return bool `true` if all code path resolves to a correct item value otherwise `false`
     */
    private function getConfigurationItemsFromPath(): bool
    {
        foreach ($this->getConstantPath() as $item) {
            if (array_key_exists($item, $this->getConstant())) {
                $this->setConstantItem($this->getConstant()[$item]);
                if (is_array($this->getConstantItem()) && count($this->getConstantPath()) > 1) {
                    foreach ($this->getConstantItem() as $key => $value) {
                        if (in_array($key, $this->getConstantPath())) {
                            $this->setConstantItem($this->getConstantItem()[$key]);
                            if (is_array($this->getConstantItem()) && count($this->getConstantPath()) > 2) {
                                foreach ($this->getConstantItem() as $key => $value) {
                                    if (in_array($key, $this->getConstantPath())) {
                                        $this->setConstantItem($this->getConstantItem()[$key]);
                                        return true;
                                    }
                                }
                            } else {
                                $this->setConstantItem($this->getConstantItem());
                                return true;
                            }
                        }
                    }
                } else {
                    $this->setConstantItem($this->getConstantItem());
                    return true;
                }
            }
            return false;
        }
        return false;
    }





}