<?php

namespace Vendor\Services\Headers;

use Vendor\Services\Data\Data;
use Vendor\Services\File\File;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Jun 15 2023 13:11:09 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Headers
 * @abstract Header Service Provider (HSP) Model.
 * Provides all service methods to HSP interface
 */
abstract class HeaderServiceProvider extends HeaderServiceConfiguration
{


    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN HEADER SERVICE CONFIGURATION
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Verify extension
     */
    protected function verifyExtension()
    {
        if (Data::inArray(parent::getFileExtension(), parent::getFileExtensions())) {
            return true;
        }
        return false;
    }

    /*
   |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
   | END HEADER SERVICE CONFIGURATION
   |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
   */

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN HEADER SERVICE PROVIDER
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    protected function getMimeFromExtension(): string|bool
    {
        if ($this->verifyExtension()) {
            parent::setMimeType($this->getContentTypes()[$this->getFileExtension()]);
            return true;
        }
        File::invalidFileExtension($this->getFileExtension());
        return false;
    }

    private function registerMimeTypeToHeader(): void
    {
        header("Content-type:" . $this->getMimeType());
        return;
    }

    public function registerAssetMimeType(string $fileExtension): bool
    {
        $this->setFileExtension($fileExtension);
        if ($this->getMimeFromExtension()) {
            $this->registerMimeTypeToHeader();
            return true;
        }
        parent::somethingUnexpectedHappened();
        return false;
    }


    private function registerRedirectLocationToHeader(): void
    {
        header("location:" . $this->getLocation());
        return;
    }


    public function setRedirectURL(string $url)
    {
        $this->setLocation($url);
        $this->registerRedirectLocationToHeader();
        return;
    }

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END HEADER SERVICE PROVIDER
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}