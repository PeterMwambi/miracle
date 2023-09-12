<?php


namespace Vendor\Services\Data;

use Vendor\Services\Exceptions\DataExceptions;

/**
 * @author Peter Mwambi
 * @date Wed Aug 09 2023 16:04:41 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Data
 * @abstract Data Service Provider - Performs data manipulation
 * - Logical Concurrency
 */
abstract class DataServiceConfiguration extends DataExceptions
{


    /**
     * #### Array Registrar
     * - This property stores an array
     * @var array $array - The array to manipulate
     */
    private array $array = [];

    /**
     * #### Array Keys Registrar
     * - This property stores array keys registered in `Array Registrar`
     * @var array $keys
     */
    private array $keys = [];

    /**
     * #### Array Replacable Keys Registrar
     * - This property stores keys that can be used to replace existing array keys in the array registered in `Array Registrar` 
     * @var array $replacableKeys
     */
    private $replacableKeys = [];


    /**
     * #### Class Registrar
     * - This property stores a called class defination
     * @var string $class - The called class 
     */
    private string $class = "";

    /**
     * #### Class Instances Registrar
     * - This property stores called class defination and allows us to manipulate stored classes
     * @param array $instances - The called class instances  
     */
    private array $instances = [];

    /**
     * #### Class Instance Registrar
     * - This property stores a called class instance that has been instantiated allowing us access the members of the class
     * @param object|null $instance - The class instance 
     */
    private object|null $instance = null;

    /**
     * #### Class Params Registrar
     * - This property stores constructor arguments found in a class and allows us to instantiate an object with its constructor
     * @param array $params - The class constructor arguments
     */
    private array $params = [];


    /**
     * #### Set Array
     * - This method registers an array to the `Array Registrar`
     * @param array $array - The array to be registered
     * @return void
     */
    protected function setArray(array $array): void
    {
        $this->array = $array;
        return;
    }


    /**
     * #### Get Array
     * - This method gets a registered array from the `Array Registrar`
     * @return array - The registered array
     */
    protected function getArray()
    {
        return $this->array;
    }


    /**
     * #### Set Array Keys
     * - This method registers array keys to the `Array Keys Registrar`
     * @param array $keys
     * @return void
     */
    protected function setArrayKeys(array $keys): void
    {
        $this->keys = $keys;
        return;
    }

    /**
     * #### Get Array Keys
     * - This method gets registered array keys from the `Array Key Registrar`
     * @return array - The registered array keys
     */
    protected function getArrayKeys()
    {
        return $this->keys;
    }

    /**
     * #### Set New Array Keys
     * - This method registers replacable keys to the `Array Replacable Keys Registrar`
     * @param array $keys - The keys to replace
     */
    protected function setNewArrayKeys(array $keys)
    {
        $this->replacableKeys = $keys;
    }


    /**
     * #### Get New Array Keys
     * - This method gets registered array keys from the `Array Replacable Keys Registrar` 
     */
    protected function getNewArrayKeys()
    {
        return $this->replacableKeys;
    }


    /**
     * #### Set Class
     * - This method registers a defined class to the class registrar
     * @param string $class - The defined class
     * @return void;
     */
    protected function setClass(string $class)
    {
        $this->class = $class;
        return;
    }

    /**
     * #### Get Class
     * - This method retrieves a stored defined class from the class registrar
     * @return string - The defined class
     */
    protected function getClass()
    {
        return $this->class;
    }

    /**
     * #### Set Params
     * - This method registers constructor arguments to the class params registrar
     * @return void
     */
    protected function setParams(array $params)
    {
        $this->params = $params;
        return;
    }

    /**
     * #### Get Params
     * - This method gets registered constructor arguments from the class params registrar
     * @return array
     */
    protected function getParams()
    {
        return $this->params;
    }


    /**
     * #### Set Instances
     * - This method pushes a defined class to the class instances registrar
     * @param string $class - The defined class
     * @return void
     */
    protected function setInstances(string $class)
    {
        $this->instances[] = $class;
        return;
    }

    /**
     * #### Get Instances
     * - This method gets registered instances from the class instances registrar
     * @return array
     */
    protected function getInstances()
    {
        return $this->instances;
    }

    /**
     * #### Set Instance
     * - This method registers an instance of a class to the class instance registrar
     * @return void
     */
    protected function setInstance(string $class)
    {
        if (!isset($this->instance)) {
            $this->instance = new $class();
        }
        return;
    }

    /**
     * #### Get Instance
     * - This method gets an instance of a defined class from the class instance registrar
     * @return object|null - The defined class instance or null if no instance has been declared
     */
    protected function getInstance()
    {
        return $this->instance;
    }

    /**
     * #### Reset Instance
     * - This method reinitializes the class instance registrar to its default value of `null`
     * @return void
     */
    protected function resetInstance()
    {
        $this->instance = null;
        return;
    }




}