<?php

use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Hooks\Autoload;
use Vendor\Services\File\File;
use Vendor\Services\Routes\Route;
use Vendor\Services\Server\Server;

/*
|```````````````````````````````````````````````````````````````````````````````````````````````````````````
|BEGIN APP CORE FUNCTIONS
|```````````````````````````````````````````````````````````````````````````````````````````````````````````
*/

/**
 * Begin class autoload
 * @return void
 */
function autoload()
{
    $autoloader = str_replace("\\", "/", dirname(dirname(__DIR__))) . "/vendor/services/hooks/autoload.php";
    if (!file_exists($autoloader)) {
        die("Autoload not found");
    }
    require_once($autoloader);
    Autoload::start();
    return;
}


function getDefaultLandingPage()
{
    if (Server::get("request/uri") === Configuration::app("root-directory") && Route::boot()->verifyProtocolIsHTTPS()) {
        File::require(Configuration::app("default-landing-page"));
        exit;
    }
    return false;
}


function getRouteServiceHandlers()
{
    File::require("app/routes/web.php");
    return;
}


function view($path)
{
    return File::require($path);
}

function asset(string $path)
{

    if (file_exists(Configuration::app("root-absolute-path") . "/" . $path)) {
        return Server::get("request/scheme") . "://" . Server::get("request/name") . "/" . $path;
    } else {
        if (File::requirePath("app/resources/" . $path)) {
            return Configuration::app("root-directory") . "app/resources/" . $path;
        }
        return false;
    }

}

/*
|``````````````````````````````````````````````````````````````````````````````````````````````````````````
| END APP CORE FUNCTIONS
|``````````````````````````````````````````````````````````````````````````````````````````````````````````
*/