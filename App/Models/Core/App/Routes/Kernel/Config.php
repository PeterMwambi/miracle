<?php

namespace Models\Core\App\Routes\Kernel;

use Models\Core\App\Dependancies\Settings as MainSettings;




final class Config extends MainSettings
{

    private $_settingsArray;

    public function GetRouteConfig()
    {
        $this->_settingsArray = parent::GetRouteSettings("Routes");
        return $this->_settingsArray;
    }

    public function GetRoutePrefix()
    {
        $routeprefix = parent::GetRouteSettings("RoutePrefix");
        return $routeprefix->routeprefix;
    }
}