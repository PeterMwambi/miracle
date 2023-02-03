<?php

namespace Models\Core\App\JSON;

use Exception;
use Models\Core\Utilities\Url;
use PDO;

/** 
 * DATABASE CONFIGURATION SETTINGS
 */



class Config
{


    private $_settingsfile;

    private function GetConfigSettingsAsArray(string $filePath, string $filename)
    {
        if (file_exists($filePath)) {
            $this->_settingsfile = file_get_contents($filePath);
            $this->_settingsfile = json_decode($this->_settingsfile);
            return $this->_settingsfile;
        }
        throw new Exception("Warning: {$filename}.json file was not found");
    }

    protected function GetConfigSettings(string $filePath, string $filename)
    {
        return $this->GetConfigSettingsAsArray($filePath, $filename);
    }

}