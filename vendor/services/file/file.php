<?php

namespace Vendor\Services\File;

use Vendor\Services\File\FileServiceProvider;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Sat Jun 10 2023 18:25:17 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\File
 * @abstract File Service Provider (FSP) Interface. 
 * Bootstraps all file services
 */

class File extends FileServiceProvider
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN LOG SERVICE PROVIDER (LSP)
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Provide a stringable format for array log data
     * This method iterates over log data of type array and produces
     * a formatted log string from the array. The data must be present 
     * in log data registrar and must be of type array.
     * @depends $this->getLogData()
     * @return string|void
     */
    protected function handleArrayData()
    {
        $data = "";
        $data .= "````````````````````````````````````````````````````````````````````\n";
        foreach ($this->getFileData() as $key => $value) {
            $data .= "{$key} : {$value} \n";
        }
        $data .= "````````````````````````````````````````````````````````````````````\n";
        return $data;
    }


    /**
     * ##### Write log data to log file
     * - This method is the final method and the heart of LSP log generator.
     * - The method takes two arguments the path to the log file and log data to be written to the file. 
     * - The method appends data to the file i.e succeeding log entries will follow after the other. Data will not be overridden
     * @param $path - A valid path to a log file
     * @param array|string - Log data to be parsed to the log file
     * @return void 
     */
    public function writeLogData(string $path, array|string $data)
    {
        $this->setFilePath($this->getRootDirPath() . "/app/logs/" . $path);
        $this->setFileData($data);
        if (is_array($this->getFileData())) {
            $this->setFileData($this->handleArrayData());
        }
        $this->appendWrite($this->getFilePath(), $this->getFileData());
        return;
    }


    /**
     * ##### Run log data write service
     * - This method provides static access to write log data file service
     * @depends `Vendor/Services/File/classes/Fileservice::writeLogData(string $path, array|string $data)`
     * 
     */
    public static function writeLog(string $path, array|string $data)
    {
        return self::boot()->writeLogData($path, $data);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END LOG SERVICE PROVIDER (LSP)
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    public static function require(string $path)
    {
        return self::boot()->getResource($path);
    }

    public static function requirePath(string $path)
    {
        return self::boot()->getPath($path);
    }


    public static function getContents(string $path)
    {
        self::boot()->setFilePath(self::requirePath($path));
        if (self::boot()->verifyFileExists()) {
            return file_get_contents(self::boot()->getFilePath());
        }
        return false;
    }

    public static function exists(string $path)
    {
        if (self::boot()->getPath($path)) {
            return $path;
        }
        return false;
    }


}