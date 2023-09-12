<?php

namespace Vendor\Services\Exceptions;


/**
 * @author Peter  Mwambi <calebmwambi@gmail.com>
 * @date Fri Jun 09 2023 06:16:10 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Exceptions
 * @abstract File Service Provider (FSP) Exception Handler. 
 * Handles all file exceptions
 */
abstract class FileServiceExceptions extends Exceptions
{
    /**
     * Throw an argument exception if path to file does not exist
     * @param mixed $path - the file path
     * @throws \InvalidArgumentException
     * @return never
     */
    public static function invalidFilePathException(string $path)
    {
        return parent::invalidArgumentException(sprintf("Invalid or missing file path: %s", $path));
    }

    /**
     * #### Invalid File Extension
     * - This method throws an exceptions when an invalid file extension is encountered
     * @param string $fileExtension - The supplied file extension
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function invalidFileExtension(string $fileExtension)
    {
        return parent::invalidArgumentException(sprintf("Warning: Unsupported file extension: %s", $fileExtension));
    }
}