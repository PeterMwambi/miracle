<?php

namespace Models\Core\App\Dependancies;

use Models\Core\App\Utilities\Url;

class Settings extends Loadjson
{



    protected function GetDBSettings(string $filename)
    {
        return parent::GetSettings($filename, "database");
    }


    protected function GetValidationRulesFromJSON(string $filename)
    {
        return parent::GetSettings($filename, "rules");
    }

    protected function GetValidationErrorsFromJSON(string $filename)
    {
        return parent::GetSettings($filename, "errors");
    }
    protected function GetRouteSettings(string $filename)
    {
        return parent::GetSettings($filename, "routes");
    }

    protected function GetFormKeys(string $filename)
    {
        return (parent::GetSettings($filename, "forms"));
    }

    protected function GetFormSettingsFromJSON(string $filename)
    {
        return (parent::GetSettings($filename, "forms"));
    }

    protected function GetFormDataFromJSON(string $filename)
    {
        return (parent::GetSettings($filename, "forms"));
    }
    protected function GetValidationKeywordsFromJSON(string $filename)
    {
        return parent::GetSettings($filename, "forms");
    }



}