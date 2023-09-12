<?php

namespace Vendor\Services\Headers;

use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Exceptions\HeaderServiceExceptions;
use Vendor\Services\Headers\Header;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Jun 15 2023 12:23:59 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Headers
 * @abstract Header Service Provider (HSP).
 * Provides all header service configurations
 */
abstract class HeaderServiceConfiguration extends HeaderServiceExceptions
{


    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN HEADER SERVICE CONFIGURATION
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | PROPERTIES
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    private static $instance;
    /**
     * #### Header Content Types Registrar
     * - This property stores all content types registered in app configuration
     * @var array $contentTypes - Registered Content Types
     */
    private array $contentTypes = [];


    /**
     * #### Content Type Registrar
     * - This property stores a fetched content type from app defined content types
     * @param string $contentType - The fetched content type
     */
    private string $contentType = "";



    /**
     * #### Header Location Registrar
     * - This property stores all user defined paths for header redirection
     * @return string - The redirect path
     */
    private string $location = "";

    /**
     * #### File Extension Registrar
     * - This property stores a file extension supplied by a user defined path
     * @param string $fileExtension - The file extension
     */
    private string $fileExtension = "";

    /**
     * #### Mime Type Registrar
     * - This method stores a defined mime type
     * - A Mime type is registered content type linked to a file extension
     * @param string $mimeType
     */
    private $mimeType;

    /**
     * #### File Extensions Registrar
     * - This property stores all defined extensions in app config
     * - File extensions are array keys in `config/app/header/content-type` configuration 
     */
    private array $fileExtensions = [];

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END PROPERTIES
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | GETTERS AND SETTERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Set Content Types
     * - This method get content types defined in App config  
     * - The method then registers fetched content types to Content Types registrar
     * @return void
     */
    private function setContentTypes(): void
    {
        $this->contentTypes = Configuration::app("content-types");
        return;
    }


    /**
     * #### Get Content Types
     * - This method bootstraps `setContentType()`.
     * - The fetches all registered app content types from app config
     * - The method returns all an array of registered content types
     * @requires `setContentType()`
     * @return array  Defined content types
     */
    protected function getContentTypes(): array
    {
        $this->setContentTypes();
        return $this->contentTypes;
    }

    /**
     * #### Set Content Type
     * - This method registers a fetched content type to the Content Type Registrar
     * @return void
     */
    protected function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
        return;
    }

    /**
     * #### Get Content Type
     * - This method gets a registered content type from the Content Type Registrar
     * @return string
     */
    protected function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * #### Set Header Location
     * - This method registers all user defined redirect paths in Header Location Registrar
     * @return void
     */
    protected function setLocation(string $location): void
    {
        $this->location = $location;
        return;
    }

    /**
     * #### Get Header Location
     * - This method gets the user defined path stored in Header Location Registrar 
     * @return string - The user defined path
     */
    protected function getLocation()
    {
        return $this->location;
    }

    /**
     * #### Set File Extension
     * - This method registers a file extension to the File Extension Registrar
     * @return void
     */

    public function setFileExtension(string $fileExtension): void
    {
        $this->fileExtension = $fileExtension;
        return;
    }

    /**
     * #### Get File Extension
     * - This method gets a registered file extension from the File Extension Registrar
     * @return string
     */
    protected function getFileExtension(): string
    {
        return $this->fileExtension;
    }


    /**
     * #### Set File Extensions
     * - This method registers app defined file extensions to File Extensions Registrar
     */
    protected function setFileExtensions(): void
    {
        $this->fileExtensions = array_keys($this->getContentTypes());
        return;
    }

    /**
     * #### Get File Extensions
     * - This method bootstraps `setFileExtensions()`.
     * - The fetches all registered file extensions from `config\app\content-types`
     * - The method returns all an array of registered extensions types
     * @requires `setFileExtensions()`
     */
    protected function getFileExtensions(): array
    {
        $this->setFileExtensions();
        return $this->fileExtensions;
    }

    /**
     * #### Set Mime Type
     * - This method registers a mime type to the Mime Type Registrar
     * @return void
     */
    protected function setMimeType(string $mimeType)
    {
        $this->mimeType = $mimeType;
        return;
    }

    /**
     * #### Get Mime Type
     * - This method gets a registered mime type from the Mime Type Registrar
     * @return string - The registered mime type
     */
    protected function getMimeType()
    {
        return $this->mimeType;
    }

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END GETTERS AND SETTERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BOOT METHODS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Register HSP interface
     * - This methods registers a HSP interface service instance to HSP service registrar
     * @param Header $route - A Route instance  
     */
    protected static function getInstance(Header $HeaderService)
    {
        if (!isset(self::$instance)) {
            self::$instance = $HeaderService;
        }
        return self::$instance;
    }

    /**
     * #### Reset HSP instance Registrar
     * - This method resets HSP instance registrar to default 
     */
    public static function resetInstance()
    {
        self::$instance = null;
    }

    /**
     * #### Boot Header Service Provider Interface
     * - This method registers an instance of HSP interface to the Header Instance Registrar
     * - This allows us to access HSP non static methods from static context
     * @return object|null
     */
    public static function boot(): Header
    {
        return self::getInstance(new Header());
    }

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END BOOT METHODS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END HEADER SERVICE CONFIGURATION
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}