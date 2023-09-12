<?php

namespace Vendor\Services\Exceptions;




/**
 * @author Peter Mwambi
 * @date Sun May 28 2023 20:33:40 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Load Env Service Provider Exception Handler(LESPEH). 
 * This class handles all exceptions during LESP life cycle
 */
abstract class EnvironmentExceptions extends Exceptions
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN LESP EXCEPTION HANDLER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Throw a runtime exception when LESP encounters an unreadable file
     * @throws \RuntimeException
     */
    public static function fileNotReadableException(string $path)
    {
        return parent::runTimeException(sprintf("{%s} file is not readable", $path));
    }

    /**
     * Throw a run time exception when LESP encounters an invalid system variable
     */
    public function envVariableNotFound(string $var)
    {
        return parent::runTimeException(sprintf("Env variable {%s} is invalid or missing", $var));
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN LESP EXCEPTION HANDLER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}