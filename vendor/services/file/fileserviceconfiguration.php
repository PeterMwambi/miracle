<?php


namespace Vendor\Services\File;

use Vendor\Services\Exceptions\FileServiceExceptions;
use Vendor\Services\File\File;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Sat Jun 10 2023 15:31:38 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\File
 * @abstract File Service Provider (FSP) Configuration. 
 * Provides all service configurations that handle files and directories 
 */


/**
 * Get App Configurations
 */
require_once(str_replace("\\", "/", dirname(__DIR__, 3)) . "/app/config/app.php");


abstract class FileServiceConfiguration extends FileServiceExceptions
{

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN FILE SERVICE CONFIGURATION
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | PROPERTIES
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    private static $instance;

    /**
     * #### Root Directory Registrar
     * - This property stores the root directory name
     * @var string $rootDir
     */
    private $rootDir = "";

    /**
     * #### Root Directory Path Registrar
     * - This property stores the root directory path
     * @var string $rootDirPath
     */
    private $rootDirPath = "";

    /**
     * #### Directory Registrar
     * - This property stores the name of a directory
     * @var string  - $dir
     */
    private string $dir = "";


    /**
     * #### File Name Registrar
     * - This property stores the name of the file
     */
    private string $fileName = "";


    /**
     * #### File Temporary name registrar
     * - This property stores a file's temporary name
     */
    private string $fileTmpName = "";

    /**
     * #### File Path Registrar
     * - This property stores a file path
     * @var string $filePath
     */
    private string $filePath = "";

    /**
     * #### File Size Registrar
     * - This property stores the file size in bytes
     * @var string $fileSize - The file size
     */
    private string $fileSize = "";

    /**
     * #### File Extension Registrar
     * - This preperty stores the file extension
     * @var string $fileExtension - The file extension
     */
    private string $fileExtension = "";

    /**
     * #### File Data Registrar
     * - This property stores file data
     * @var string|array $fileData  
     */
    private array|string $fileData;

    /**
     * #### File Accronym Registrar
     * - This property stores a file action accronym
     * - File action accronyms include `r` `w` `w+` `r+` `a` `a+`
     * @var string $fileActionAccronym - The file action accronym
     */
    private string $fileActionAccronym = "";


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
     * #### Get Project Root Directory
     * - This method gets the project root directory name from Route Directory Registrar
     * @return string
     */
    public function getRootDir(): string
    {
        $this->setRootDir();
        return $this->rootDir;
    }

    /**
     * #### Set Project Root Directory
     * - This method registers the project root directory name to the Root Directory Registrar 
     * @return void
     */
    private function setRootDir(): void
    {
        $this->rootDir = APP_CONFIGURATION_SETTINGS["root-directory"];
        return;
    }

    /**
     * #### Get Project Root Directory Path
     * - This method gets the project root diretory path from Route Directory Path Registrar
     * @return string
     */
    public function getRootDirPath(): string
    {
        $this->setRootDirPath();
        return $this->rootDirPath;
    }

    /**
     * #### Set project root directory path
     * - This method registers the project root directory path to the Route Directory Path Registrar
     * @return void
     */
    private function setRootDirPath(): void
    {
        $this->rootDirPath = APP_CONFIGURATION_SETTINGS["root-directory-path"];
        return;
    }


    /**
     * #### Set file name
     * - This method registers a file name to the file name registrar
     * @param string $fileName - The file name
     */
    protected function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
        return;
    }

    /**
     * #### Get file name
     * - This method gets a registered file name from file name registrar
     */
    protected function getFileName()
    {
        return $this->fileName;
    }


    /**
     * #### Set file temporary name
     * - This method registers a temporary file name to temporary file name registrar
     */
    protected function setFileTmpName(string $fileTmpName)
    {
        $this->fileTmpName = $fileTmpName;
        return;
    }

    /**
     * #### Get file temporary name
     * - This method gets a registered temporary file name from the temporary file name registrar
     */
    protected function getFileTmpName()
    {
        return $this->fileTmpName;
    }

    /**
     * #### Get File path
     * - This method gets a registered file path from File Path Registrar
     * @return string
     */
    protected function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * #### Set file path
     * - This method registers a file path to the File Path Registrar
     * @return void
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
        return;
    }

    /**
     * #### Get File Data
     * - This method gets registered file data from File Data Resistrar 
     * @return string|array
     */
    protected function getFileData(): array|string
    {
        return $this->fileData;
    }

    /**
     * #### Set File Data
     * - This method registers file data to File Data Registrar
     * @param string|array $fileData - File data to be stored
     * @return void
     */
    public function setFileData(array|string $fileData): void
    {
        $this->fileData = $fileData;
        return;
    }

    /**
     * #### Get File Action Accronym
     * - This method registers a file action accronym to File Accronym Registrar
     * @return string
     */
    protected function getFileAccronym(): string
    {
        return $this->fileActionAccronym;
    }

    /**
     * #### Set File Action Accronym
     * - This method registers a file action to File Action Registrar
     * @param mixed $fileActionAccronym - File action
     * @return void
     */
    protected function setFileAccronym(string $fileActionAccronym): void
    {
        $this->fileActionAccronym = $fileActionAccronym;
        return;
    }


    /**
     * #### Set Directory
     * - This methods registers a directory to the Directory Registrar 
     * @param string $dir - The registered directory
     * @return void
     */
    protected function setDir(string $dir): void
    {
        $this->dir = $dir;
        return;
    }

    /**
     * #### Get Directory
     * - This method gets a registered directory from the Directory Registrar
     * @return string
     */
    protected function getDir(): string
    {
        return $this->dir;
    }

    /**
     * #### Set File Size
     * - This method registers the file size to the File Size Registrar
     * @return void
     */
    protected function setFileSize(string $fileSize): void
    {
        $this->fileSize = $fileSize;
        return;
    }

    /**
     * #### Get File Size
     * - This method gets a registered file size from the File Size Registrar
     * @return string
     */
    protected function getFileSize(): string
    {
        return $this->fileSize;
    }

    /**
     * #### Set File Extension
     * - This method registers a file extension to the file extension registrar
     * @return void
     */
    protected function setFileExtension(string $fileExtension): void
    {
        $this->fileExtension = $fileExtension;
        return;
    }

    /**
     * #### Get File Extension
     * - This method gets a registerd file extension from the file extension registrar
     */
    protected function getFileExtension(): string
    {
        return $this->fileExtension;
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
     * #### Register RSP interface
     * - This methods registers an FSP interface service instance to FSP service registrar
     * @param File $route - A Route instance  
     */
    public static function getInstance(File $FileService)
    {
        if (!isset(self::$instance)) {
            self::$instance = $FileService;
        }
        return self::$instance;
    }

    /**
     * #### Reset FSP instance Registrar
     * - This method resets FSP instance registrar to default 
     */
    public static function resetInstance()
    {
        self::$instance = null;
    }

    /**
     * #### Boot File Service Provider Interface
     * - This method registers an instance of FSP interface to the File Instance Registrar
     * - This allows us to access FSP non static methods from static context
     * @return object|null
     */
    public static function boot(): File
    {
        return self::getInstance(new File());
    }

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END BOOT METHODS
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END FILE SERVICE CONFIGURATION
    |````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}