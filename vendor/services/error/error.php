<?php

namespace Vendor\Services\Error;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Sep 28 2023 05:35:53 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Errror
 * @abstract Error Reporting Service - Contains all error reporting functions 
 */

class Error extends ErrorServiceProvider
{

    public function reportErrors()
    {
        return $this->setDynamicErrorReportingFromEnv();
    }
}