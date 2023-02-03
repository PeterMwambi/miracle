<?php


namespace Models\Core\App\Dependancies;

use Models\Core\App\JSON\Config as JSONParser;
use Models\Core\App\Utilities\Url;

class Loadjson extends JSONParser
{



    public function GetSettings(string $filename, string $base)
    {
        return parent::GetConfigSettings(Url::GetPath("app/config/{$base}/{$filename}.json"), $filename);
    }
}