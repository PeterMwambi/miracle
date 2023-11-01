<?php

namespace Vendor\Services\Error;

use Vendor\Services\Environment\Environment;

abstract class ErrorServiceProvider extends ErrorServiceConfiguration
{


    /**
     * #### Set Dynamic Error Reporting
     * - This method creates a dynamic error reporting system from configured environment variable
     * - Environment can either be `development` or `production`
     * @return self
     */
    protected function setDynamicErrorReportingFromEnv()
    {
        $this->setEnvironment(Environment::get("ENVIRONMENT"));
        $this->dynamicErrorReporter();
        return $this;
    }



    private function dynamicErrorReporter()
    {
        switch ($this->getEnvironment()) {
            case "development":
                $this->setErrorLevel(E_ALL);
                $this->setErrorReporting($this->getErrorLevel());
                break;
            case "production":
                $this->setErrorLevel(0);
                $this->setErrorReporting($this->getErrorLevel());
                break;
            default:
                throw new \Exception(sprintf("Warning: Invalid ENVIRONMENT variable %s", $this->getEnvironment()));
        }
        return $this;
    }

}