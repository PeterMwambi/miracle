<?php

use PSpell\Config;
use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Core\Autoload;
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
    $autoloader = str_replace("\\", "/", dirname(dirname(__DIR__))) . "/vendor/services/core/autoload.php";
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
    File::require("app/routes/webassets.php");
    File::require("app/routes/webroutes.php");
    return;
}


function view($path)
{
    if (file_exists($path)) {
        die("true");
    } else {
        die("false");
    }
}

function asset(string $path)
{
    if (File::requirePath("app/resources/" . $path)):
        return Configuration::app("root-directory") . "app/resources/" . $path;
    endif;
}

/*
|``````````````````````````````````````````````````````````````````````````````````````````````````````````
| END APP CORE FUNCTIONS
|``````````````````````````````````````````````````````````````````````````````````````````````````````````
*/