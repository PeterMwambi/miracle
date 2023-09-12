<?php

namespace Vendor\Services\Validation;

use Vendor\Services\Exceptions\Exceptions;
use Vendor\Services\Hooks\Rules;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Mon Aug 21 2023 17:38:34 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Validation
 * @abstract - Validation Service Provider Configuration - Contains validation configurations
 */
abstract class ValidationServiceConfiguration extends Exceptions
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN VALIDATION SERVICE PROVIDER (VSP) CONFIGURATION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Validation Error Bag Registrar
     * - This property stores defined validation errors to be displayed to the user 
     * @var array $errors - Validation errors
     */
    private array $errors = [];


    /**
     * #### Validation Error Message Registrar
     * - This property stores validation error messages encountered during validation of data
     */
    private array $error = [];

    /**
     * #### Validation Confirmation Registrar
     * - This property stores the validation confirmation status
     * @var bool $passed - Validation confirmation status 
     */
    private bool $passed = false;

    /**
     * #### Validation Data Registrar
     * - This property stores the data to be validated
     * @var array|string $data - Validation data
     */
    private array|string $data = [];

    /**
     * #### Validation Data Keys Registrar
     * - This property stores the keys of the data to be validated
     * @var string $key - Validation data keys
     */
    private string $key = "";

    /**
     * #### Validation Keyword Registrar
     * - This property stores a validation keyword
     * @var string $keyword - The validation keyword
     */
    private string $keyword = "";


    /**
     * #### Validation Rules Registrar
     * - This property stores defined validation rules set to verify data
     * - Validation rules are defined in key value pairs
     * - Keys of the data to be validated serve as keys to identify the rules for each validatable item  
     * @var array $rules - The validation rules
     */
    private array $rules = [];


    /**
     * #### Validation Rules Module Registrar
     * - Thi method registers an instance of the validation rule module and allows us to format string rules 
     * @var Rules $ruleModule - The validation rule module
     */
    private Rules $ruleModule;


    /**
     * #### Validation Rule Value Registrar
     * - This property stores the validation rule value assigned to a validatable data item
     * @var string|int|array $value - The validation rule value
     */
    private string|int|array $value = "";



    /**
     * #### Validation Filters Registrar
     * - This property stores filter constants assigned to filter data using php `filter_var()` method.
     * - This allows us to validate data based on specified filter flags e.g `FILTER_VALIDATE_EMAIL` 
     * @var array $filters - The validation filters
     */
    private array $filters = [];

    /**
     * #### Validation Database Registrar
     * - This property stores the name of the database that we want to query for validation
     * @var string $database - The validation database name
     */
    private string $database = "";

    /**
     * #### Validation Table Registrar
     * - This property stores the name of the database table that we are validating
     * @var string $table - The validation table
     */
    private string $table = "";

    /**
     * #### Validation Column Registra
     * - This property stores the name of the database column that we are validating
     * @var string|array - The validation column
     */
    private array|string $column = "";

    /**
     * #### Validation Reference Registrar
     * - This property stores a reference name to a database column incase we need to query more than one field
     * @var string $reference - The validation column reference name
     */
    private string $reference = "";

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */



    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | GET AND SET METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Get Errors
     * - This method gets validation errors registered in validation error bag registrar
     * @return array
     */
    protected function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * #### Set Errors
     * - This method registers validation erros to the validation error bag registrar
     * @param array $errors - The validation error bag
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * #### Get Error Message
     * - This method gets a validation error message from the validation error message
     * @return array
     */
    protected function getError(): array
    {
        return $this->error;
    }

    /**
     * #### Set Error Message
     * - This method registers an error message to the validation error message registrar
     * @param string $error - The validation error message
     * @return self
     */
    protected function setError(string $error): self
    {
        $this->error[] = $error;
        return $this;
    }

    /**
     * #### Get Confirmation Status
     * - This method gets the validation confirmation status from the validation onfirmation registrar
     * @return bool
     */
    protected function getPassed(): bool
    {
        return $this->passed;
    }

    /**
     * #### Set Confirmation Status
     * - This method registers the validation confirmation status to the validation confirmation registrar
     * @param bool $passed - The validation confirmation status
     * @return self
     */
    protected function setPassed(bool $passed): self
    {
        $this->passed = $passed;
        return $this;
    }

    /**
     * #### Get Validation Data
     * - This method gets validation data from validation data registrar 
     * @return array|string
     */
    protected function getData(): array|string
    {
        return $this->data;
    }

    /**
     * #### Set Validation Data
     * - This method registers validation data to validation data registrar  
     * @param array|string $data -  The validation data
     * @return self
     */
    public function setData(array|string $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * #### Get Data Keys
     * - This method registers validation data keys to validation data regisrtrar
     * @return string
     */
    protected function getKey(): string
    {
        return $this->key;
    }

    /**
     * #### Set Data Keys
     * - This method registers validation daka keys to validation data keys registrar
     * @param string $key - The validation data keys
     * @return self
     */
    protected function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    /**
     * #### Get Keywords
     * - This method gets validation keywords from the validation keywords registrar
     * @return string
     */
    protected function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * #### Set Keywords
     * - This method registers validation keywords to the validation keyword registrar
     * @param string $keyword - The validation keywords
     * @return self
     */
    protected function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;
        return $this;
    }

    /**
     * #### Get Rules
     *- This method gets validation rules from the validation rules registrar
     * @return array
     */
    protected function getRules(): array
    {
        return $this->rules;
    }

    /**
     * #### Set Rules
     * - This method registers validation rules to the validation rules registrar
     * @param array $rules - The validation rules
     * @return self
     */
    public function setRules(array $rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * #### Get validation rule value
     * - This method gets validation rule values from validation rule value registrar
     * @return string|int|array
     */
    protected function getValue(): string|int|array
    {
        return $this->value;
    }

    /**
     * #### Set rule value
     * - This method registers validation rule values to the validation rules registrar
     * @param string|int|array $value - The validation rule value 
     * @return self
     */
    protected function setValue(string|int|array $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * #### Get Filters
     *- This method gets validation filters from the validation filters registrar
     * @return array
     */
    protected function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * #### Set Filters
     * - This method registers validation filters to the validation filters registrar
     * @param array $filters - The validation filters
     * @return self
     */
    protected function setFilters(array $filters): self
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * #### Get Database
     * - This method gets the validation database name from the validation database registrar
     * @return string
     */
    protected function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * #### Set Database
     * - This method registers the validation database name to the validation database registrar
     * @param string $database - The validation database
     * @return self
     */
    protected function setDatabase(string $database): self
    {
        $this->database = $database;
        return $this;
    }

    /**
     * #### Get Table
     * - This method gets the database table from the validation database registrar 
     * @return string
     */
    protected function getTable(): string
    {
        return $this->table;
    }

    /**
     * #### Set Table
     * - This method registers the database table to the validation database registrar
     * @param string $table - The validation table
     * @return self
     */
    protected function setTable(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * #### Get Column
     * - This method gets the validation column from the validation column registrar
     * @return array|string
     */
    protected function getColumn(): array|string
    {
        return $this->column;
    }

    /**
     * #### Set Column
     * - This method registers the validation column to the validation column registrar
     * @param array|string $column - The validation column
     * @return self
     */
    protected function setColumn(array|string $column): self
    {
        $this->column = $column;
        return $this;
    }

    /**
     * #### Get Reference
     * - This method gets the validation reference name from the validation reference registrar
     * @return string
     */
    protected function getReference(): string
    {
        return $this->reference;
    }

    /**
     * #### Set Reference
     * - This method registers the validation reference name to the validation reference name registrar
     * @param string $reference - The validation reference name
     * @return self
     */
    protected function setReference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @todo Request For Documentation
     * #### Validation Rules Module Registrar
     * - Thi method registers an instance of the validation rule module and allows us to format string rules
     * @return Rules
     */
    protected function getRuleModule(): Rules
    {
        return $this->ruleModule;
    }

    /**
     * #### Validation Rules Module Registrar
     * - Thi method registers an instance of the validation rule module and allows us to format string rules
     * @param Rules $ruleModule #### Validation Rules Module Registrar
     * @return self
     */
    protected function setRuleModule(Rules $ruleModule): self
    {
        $this->ruleModule = $ruleModule;
        return $this;
    }


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END GET AND SET METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}