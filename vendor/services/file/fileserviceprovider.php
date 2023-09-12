<?php

namespace Vendor\Services\File;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Fri Jun 09 2023 06:16:10 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\File
 * @abstract File Service Provider (FSP) model. 
 * Provides file handling methods to FSP interface
 */
abstract class FileServiceProvider extends FileServiceConfiguration
{

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN FILE SERVICE PROVIDER
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN FILE READ/WRITE SERVICE
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Write File Data
     * - This method writes data to file
     * @param string $path - The target file
     * @param string $accronym - The write action accronym i.e `w`, `w+`, `a`, `a+`
     * @param string $data - The data to be written to file
     * @return void 
     */
    protected function write(string $path, string $accronym, string $data): void
    {
        $this->setFilePath($path);
        $this->setFileData($data);
        $this->setFileAccronym($accronym);
        $file = fopen($this->getFilePath(), $this->getFileAccronym());
        fwrite($file, $this->getFileData());
        fclose($file);
        return;
    }

    /**
     * Opens a file and writes data at the end of the last line.
     * This method does not overwrite existing data in a file
     * @param string $path - Path to the file
     * @param string $data - Data to write into the file
     */
    public function appendWrite(string $path, string $data)
    {
        return $this->write($path, "a", $data);
    }

    /**
     * Opens a file for write. This method overwirites all existing
     * data in a file and should be used with caution
     * @param string $path - Path to file
     * @param string $data - Data to write into the file
     */
    public function clearWrite(string $path, string $data)
    {
        return $this->write($path, "w", $data);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END FILE READ/WRITE SERVICE
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | FILE SERVICE SECURITY HANDLERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN FILE VERIFICATION HANDLERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Check File exists
     * - This method verifies if a file or directory registered to File Path Registrar exists in File system
     * @return bool
     */
    public function verifyFileExists(): bool
    {
        if (file_exists($this->getFilePath())) {
            return true;
        }
        parent::invalidFilePathException($this->getFilePath());
    }

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END FILE VERIFICATION HANDLERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    |END FILE SERVICE SECURITY HANDLERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */



    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | FILE SERVICE ACCESS HANDLERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Require file from Directory Tree
     * - This method verifies if a file path exists
     * - The method then passes the file to the calling script
     * @param int $flag - Require control flag
     * @throws \Exception  `Vendor\Services\Exceptions\FileServiceExceptions::invalidFilePathException()`
     * @return bool
     */
    protected function requireFile(int $flag = 0): bool
    {
        if ($this->verifyFileExists()) {
            switch ($flag) {
                case 0;
                    require_once($this->getFilePath());
                    return true;
                case 1;
                    require($this->getFilePath());
                    return true;
            }
        }
        $this->invalidFilePathException($this->getFilePath());
        return false;
    }

    /**
     * #### Get File Resource Path
     * - This method returns the absolute path to a specific file in the projects directory from its relative path
     * - The relative file path must be a linked file or folder at root level hierarchy
     * @param string $path - Relative file path 
     */
    public function getPath(string $path): string|bool
    {
        $this->setFilePath($this->getRootDirPath() . "/" . $path);
        if ($this->verifyFileExists()) {
            return $this->getFilePath();
        }
        $this->invalidFilePathException($this->getFilePath());
        return false;
    }

    /**
     * #### Get Resource
     * - This method requires a file into the calling script
     * @param string $path - A relative file path
     * @param int $flag - Require control flag
     */
    public function getResource(string $path, int $flag = 0)
    {
        $this->setFilePath($this->getRootDirPath() . "/" . $path);
        return $this->requireFile($flag);
    }

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END FILE SERVICE ACCESS HANDLERS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */



    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END FILE SERVICE PROVIDER
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
   */

}