<?php

namespace Vendor\Services\Validation;

use Vendor\Services\Configuration\Configuration as Config;
use Vendor\Services\Data\Data;
use Vendor\Services\Database\Database;
use Vendor\Services\Hooks\Rules;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Mon Aug 28 2023 20:47:41 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Validation
 * @abstract Validation Service Provider - Contains validation methods
 */
abstract class ValidationServiceProvider extends ValidationServiceConfiguration
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN VALIDATION SERVICE PROVIDER (VSP) METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### __construct
     * - The constructor binds together all validation methods and allows us to validate data
     * @param array|object $data - The data to be validated
     * @param array|object $rules - The validation rules
     * @param array|object $errors - The validation errors
     * @return void
     */
    public function __construct(array|object $data = [], array|object $rules = [], array|object $errors = [])
    {
        $this->setData($data);
        $this->setRules($rules);
        $this->setErrors($errors);
        $this->execute();
    }


    /**
     * #### Set Rules
     * - This method checks to see if a defined set of rules are either `string rules` or `array rules`
     * - In the case of string rules, they will be formatted to an array readable format that can be parsed to produce rules for validation
     * - In case of array rules, they will be parsed directly to produce rules for validation
     * - This method is inherited from the parent `setRules()` method. 
     * @param array $rules - The rules to validate data
     * @return self
     */
    public function setRules(array $rules): self
    {
        $this->setRuleModule(new Rules());
        if ($this->getRuleModule()->generateFormattedRules($rules)) {
            parent::setRules($this->getRuleModule()->generateFormattedRules($rules));
        } else {
            parent::setRules($rules);
        }
        return $this;
    }



    /**
     * #### Write Error
     * - This method registers an encountered error to the error registrar during validation
     * - This allows us to catch any errors and display them to the end user
     * - A type flag has been used to control different error registration modes.
     * @param string $type - Specifies the error registration mode `count` registers count mode without keywords `default` value registers error messages with keywords as part of error bag keys 
     * @return self  
     */
    protected function writeError(string $type = ""): self
    {
        switch ($type) {
            case "count":
                return $this->setError($this->getErrors()[$this->getKey()][$this->getKey()]);
            default:
                return $this->setError($this->getErrors()[$this->getKey()][$this->getKeyword()]);
        }
    }

    /**
     * #### Validate Minimum Length
     * - This method calculates the length of a string and checks if it is less than the length specified in the rule value. If so, the method generates an error
     * - Rule values are registered by the validation rule value registrar
     * @return false - Returns false by default
     */
    protected function validateMinLength(): bool
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            (strlen($this->getData()[$this->getKey()]) < $this->getValue()) &&
            !isset($this->getRules()["count"])
        ) {
            $this->writeError();
            return false;
        }
        return false;
    }


    /**
     * #### Validate Maximum Length
     * - This method calculates the length of a string and checks if it is greater than the length specified in the rule value If so, the method generates an error
     * - Rule values are registered by the validation rule value registrar
     * @return false - Returns false by default
     */
    protected function validateMaxLength(): bool
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            strlen($this->getData()[$this->getKey()]) > $this->getValue() &&
            !isset($this->getRules()["count"])
        ) {
            $this->writeError();
            return false;
        }
        return false;
    }


    /**
     * #### Validate Mininmum Number
     * - This method compares the value of a number and checks to see if it is less than the number specified in the rule value. If so, the method generates an error
     * - Rule values are registered by the validation rule value registrar
     * @return false - Returns false by default
     */
    private function validateMinCount(): bool
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            $this->getData()[$this->getKey()] < $this->getValue()
        ) {
            $this->writeError("count");
            return false;
        }
        return false;
    }

    /**
     * #### Validate Mininmum Number
     * - This method compares the value of a number and checks to see if it is greater than the number specified in the rule value. If so, the method generates an error
     * - Rule values are registered by the validation rule value registrar
     * @return false - Returns false by default
     */
    private function validateMaxCount(): bool
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            $this->getData()[$this->getKey()] > $this->getValue()
        ) {
            $this->writeError("count");
            return false;
        }
        return false;
    }

    /**
     * #### Validate Count
     * - This method binds together all number validation methods and attempts to validate the number value of an interger
     * @depends Vendor\Services\Validation\ValidatonServiceProvider::validateMinCount()
     * @depends Vendor\Services\Validation\ValidatonServiceProvider::validateMaxCount()
     * @return self|false
     */
    protected function validateCount(): self|bool
    {
        foreach ($this->getRules() as $key => $value):
            $this->setKey($key);
            $this->setValue($value);
            switch ($key) {
                case "min":
                    return $this->validateMinCount();
                case "max":
                    return $this->validateMaxCount();
            }
        endforeach;
        return $this;
    }

    /**
     * #### Validate Required
     * - This method checks if a given key has been set in the data to validate
     * - The method checks if the required keyword has been set to true then checks if the data key is set. If the keyword has been set to false the method ignores the data key
     * @return self|false - Returns false by default
     */
    protected function validateRequired(): self|bool
    {
        switch ($this->getValue()) {
            case true:
                if (empty($this->getData()[$this->getKey()])) {
                    $this->writeError();
                    return false;
                }
                break;
            default:
                return false;
        }
        return $this;
    }

    /**
     * #### Validate Required Any
     * - This method checks to see if any of the data keys specified in the rule value have been set in the data to be validated
     * - If no keys have been set in the data, the method generates an error
     * @return self|false
     */
    protected function validateRequiredAny()
    {
        foreach ($this->getValue() as $key) {
            if (isset($this->getData()[$key])) {
                return false;
            } else {
                $this->writeError();
                return false;
            }
        }
        return $this;
    }


    /**
     * #### Validate With Filter
     * - This method vatidates a data item based on specified set filters.
     * - Filters can be defined in `app` configuration located in the `app/config/app.php` file and be set when defining rules for data validation
     * - Filters include `FILTER_VALIDATE_IP`, `FILTER_VALIDATE_EMAIL`
     * @return self|false
     */
    protected function validateWithFilter(): self|false
    {
        if (isset($this->getData()[$this->getKey()]) && $this->fetchFilter()) {
            if (!filter_var($this->getData()[$this->getKey()], $this->fetchFilter())) {
                $this->writeError();
                return false;
            }
            return false;
        }
        return $this;
    }

    /**
     * #### Validate With Pattern 
     * - This method checks for a pattern within a string data item. The pattern is defined in the rule value
     * - If the data item does not correspond to the specified pattern the mmethod generates an error
     * @return self|false
     */
    protected function validateWithPattern(): self|bool
    {
        if (isset($this->getData()[$this->getKey()]) && $this->fetchPattern()) {
            if (!preg_match($this->fetchPattern(), $this->getData()[$this->getKey()])) {
                $this->writeError();
                return false;
            }
            return false;
        }
        return $this;
    }


    /**
     * #### Validate With Database
     * - This method checks to see if a data item exists in a database table.
     * - Database validation takes two approaches. Data can either exist or not exist in the database table
     * @return self|false
     */
    protected function validateWithDatabase(): self|bool
    {
        if (count($this->getRules())) {
            $this->setDatabase($this->getRules()["database"]);
            $this->setTable($this->getRules()["table"]);
            $this->setColumn($this->getRules()["column"]);
            return $this->validateDBData();
        }
        return false;
    }

    /**
     * #### Has Reference Column
     * - This method checks to see if a rule item has a `reference` keyword.
     * - The reference keyword stores a reference column to be queried incase we want to identify a base column to support our query
     * - This method is used for password validation
     * @return bool - `true` if reference keyword has been specified otherwise `false` 
     */
    private function hasReferenceColumn(): bool
    {
        if (isset($this->getRules()["reference"])) {
            return true;
        }
        return false;
    }

    /**
     * #### Validate Unique Data
     * - This method validates data that exists in a database table
     * - The method validates with the `reference` keyword as the base for validation decision
     * - If the `reference` column has been specified the method verifies a password aganist its hash from the database, otherwise the method checks if a specified data item exists in a database table.  
     * @return self|false  
     */
    private function validateUniqueData(): self|bool
    {
        switch ($this->hasReferenceColumn()) {
            case true:
                if (!$this->getPasswordHashFromDBAndCompareWithPassword()) {
                    $this->writeError();
                    return false;
                }
                break;
            case false:
                if ($this->validateExistentData()) {
                    $this->writeError();
                    return false;
                }
                break;
        }
        return $this;
    }

    /**
     * #### Validate Non Unique Data
     * - This method checks to see if the data item supplied does not exist in the database. 
     * - If the data item exists the method generates an error
     * @return self|false
     */
    private function validateNonUniqueData(): self|bool
    {
        if (!$this->validateExistentData()) {
            $this->writeError();
            return false;
        }
        return $this;
    }

    /**
     * #### Get Database Count
     * - This method checks to see if a data item exists in a database table and returns a row count
     * - If the data item exists in the table the method returns `true` otherwise `false`
     * @return bool
     */
    private function getDBCount(): bool
    {
        if (
            Database::query($this->getDatabase())->select(
                $this->getTable(),
                Data::isArray($this->getColumn()) ? $this->getColumn() : [$this->getColumn()],
                [$this->getColumn(), "=", $this->getData()[$this->getKey()]]
            )->getCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * #### Compare DB Password Hash With Password
     * - This method gets a password hash from a database and compares it with a plain password.
     * - If the password hash does not match the supplied password or no password has is found in the database, The method generates an error  
     * @return bool
     */
    private function getPasswordHashFromDBAndCompareWithPassword(): bool
    {
        $this->setReference($this->getRules()["reference"]);
        $query = Database::query($this->getDatabase())->select($this->getTable(), [$this->getColumn()], [$this->getReference(), "=", $this->getData()[$this->getRules()["reference"]]]);
        if ($query->getCount() && password_verify($this->getData()[$this->getColumn()], $query->getResults()[$this->getColumn()])) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * #### Validate DB Data
     * - This method validates database data based on the boolean value passed to the rule value registrar from the `unique` keyword
     * - If the value passed is `true` The method checks if the data item exists in the database otherwise `false` checks if a record does not exist in the database
     * @return self|false 
     */
    private function validateDBData(): self|bool
    {
        switch ($this->getValue()) {
            case true:
                return $this->validateUniqueData();
            case false:
                return $this->validateNonUniqueData();
        }
        return $this;
    }

    /**
     * #### Validate Existent Data
     * - This method checks if a data item exists in a database by verifying its row count
     * - The method return `true` if the data item exists otherwise the method returns `false`
     * @return bool
     */
    private function validateExistentData(): bool
    {
        if ($this->getDBCount()) {
            return true;
        }
        return false;
    }



    /**
     * #### Fetch Filter
     * - This method fetches a filter constant from app configuration settings.
     * - The constant is used to verify a data item if it matches the specified filter.
     * @return string|false
     */
    private function fetchFilter(): string|bool
    {
        if (Data::arrayKeyExists($this->getKey(), Config::app("filters"))) {
            return Config::app("filters")[$this->getKey()];
        }
        return false;
    }

    /**
     * #### Fetch Pattern
     * - This method fetches a defined pattern from app configuration settings
     * - The pattern is used to verify a data item if it matches its creteria
     * @return string|false
     */
    private function fetchPattern(): string|bool
    {
        if (Data::arrayKeyExists($this->getValue(), Config::app("patterns"))) {
            return Config::app("patterns")[$this->getValue()];
        }
        return false;
    }




    /**
     * ##### Validate With Keyword
     * - This method binds together all validation methods and allows us to validate data.
     * - Validation methods MUST be defined inn the app configuration file
     * - The method executes validation functions based on their keywords therefore keywords and methods must be defined in key value pairs in app configuration
     * @return self|false
     */
    private function validateWithKeyword(): self|bool
    {
        foreach (Config::app("methods") as $key => $method):
            if (Data::methodExists($this, $method)) {
                switch ($this->getKeyword()) {
                    case $key:
                        return $this->$method();
                }
            }
        endforeach;
        return $this;
    }

    /**
     * #### Execute validation
     * - This method runs data validation
     * - The method puts together all configuration values and performs data validation 
     * @return self|false
     */
    private function execute(): self|bool
    {
        foreach ($this->getRules() as $key => $rules):
            foreach ($rules as $keyword => $value):
                $this->setKeyword($keyword);
                $this->setKey($key);
                $this->setValue($value);
                parent::setRules($rules);
                $this->validateWithKeyword();
            endforeach;
        endforeach;
        return $this;
    }

    /**
     * #### Verify validation
     * - This method checks to see if data validation has succeeded i.e there are no errors refietered in the validation error registrar
     * - If there are no errors the method sets the validation status to `true` otherwise the validation status remains `false` 
     */
    public function passed()
    {
        if (count($this->getError()) <= 0) {
            $this->setPassed(true);
        }
        return $this->getPassed();
    }

    /**
     * #### Display Error
     * - This method gets an encountered error during vaidation when the validation status resolves to false
     * - The method then displays the error to the end user
     * @return string|false
     */
    public function displayError(): string|bool
    {
        foreach ($this->getError() as $error):
            return $error;
        endforeach;
        return false;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END VALIDATION SERVICE PROVIDER (VSP) METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


}