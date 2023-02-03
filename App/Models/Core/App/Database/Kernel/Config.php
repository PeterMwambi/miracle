<?php

namespace Models\Core\App\Database\Kernel;

use Models\Core\App\Dependancies\Settings as MainSettings;
use Exception;

//Database Configuration settings;
//Get Configuration Settings from JSON file
class Config extends MainSettings
{

    private $_settingsArray = array();


    private function GetDatabaseConfig()
    {
        $this->_settingsArray = parent::GetDBSettings("DatabaseConnection");
        return $this->_settingsArray;
    }



    public function GetHost()
    {
        return $this->GetDatabaseConfig()->host;
    }
    public function GetUsername()
    {
        return $this->GetDatabaseConfig()->username;
    }
    public function GetPassword()
    {
        return $this->GetDatabaseConfig()->password;
    }

    public function GetDBName()
    {
        return $this->GetDatabaseConfig()->name;
    }

}