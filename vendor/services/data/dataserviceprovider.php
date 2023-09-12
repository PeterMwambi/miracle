<?php

namespace Vendor\Services\Data;

/**
 * @author Peter Mwambi
 * @date Wed Aug 09 2023 16:04:41 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Data
 * @abstract Data Service Provider - Performs data manipulation
 */
abstract class DataServiceProvider extends DataServiceConfiguration
{


    /**
     * #### Format Array Keys
     * - This method replaces keys in an array with new customised keys. 
     * - The number of items in the haystack array must be equal to the number of items in the new key array.
     * @param array $array - The haystack array
     * @param array $keys - The new keys to format the haystack array
     */
    public function formatArrayKeys(array $array, array $keys)
    {
        if (Data::count($keys) === Data::count($array)) {
            $this->setArray($array);
            $this->setArrayKeys(Data::arrayKeys($array));
            $this->setNewArrayKeys($keys);
            return (Data::combineArray($this->getNewArrayKeys(), Data::arrayValues($this->getArray())));
        }
        parent::invalidArrayKeysCount();
        return false;
    }

    /**
     * #### Register Class to Instance
     * - This method registers a class to the class instance registrar and allows us to access methods and properties contained in the class
     * - The class is verified to confirm if it exists. If there be any existing instance in the class instance registrar, the registrar is set to its default value.
     * - The method then retrieves an instance of the registered class.
     * @return object|false - The defined class instance on success or false on failure.
     */
    protected function registerClassToInstance()
    {
        if (Data::classExists($this->getClass())) {
            $this->resetInstance();
            $this->setInstance($this->getClass());
            return $this->getInstance();
        }
        return false;
    }

    /**
     * #### Generate New Instance
     * - This method generates an instance of the defined class.
     * - The method registers a class to the class registrar and the class instances registrar. 
     * - The method then checks to see if a defined class name corresponds to the registered class then instanciates the class
     * - The method then produces an object of the instantiated class
     * @return object|false|void - The defined class on success, false on failure, void if class has been instantiated   
     */
    public function generateNewInstance(string $class)
    {
        $this->setClass($class);
        $this->setInstances($this->getClass());
        for ($x = 0; $x < count($this->getInstances()); $x++) {
            if ($this->getClass() === $this->getInstances()[$x]) {
                return $this->registerClassToInstance();
            }
        }
        return;
    }

}