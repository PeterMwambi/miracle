<?php


namespace Vendor\Services\Validation;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Mon Aug 28 2023 21:27:48 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Validation
 * @abstract Validation Service Provider - Provides a gateway to access abstract validation methods
 * @todo Generate Error handlers for misconfigured data
 */
class Validation extends ValidationServiceProvider
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN VALIDATION SERVICE PROVIDER (VSP) GATEWAY
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Validate
     * - This method runs validation directly from the constructor
     * - The method binds together all required validation inputs and executes data validation
     * @param array|object $data - The data to be validated
     * @param array|object $rules - The validation rules
     * @param array|object $errors - The validation errors to be displayed
     * @return self
     */
    public static function validate(array|object $data, array|object $rules, array|object $errors): self
    {
        return (new Validation($data, $rules, $errors));
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END VALIDATION SERVICE PROVIDER (VSP) GATEWAY
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}