<?php

use Vendor\Services\Data\Data;
use Vendor\Services\Error\Error;
use Vendor\Services\Routes\Route;

/*
|``````````````````````````````````````````````````````````````````````````````````````````````````````````````````
| BEGIN ROUTER SERVICE
|``````````````````````````````````````````````````````````````````````````````````````````````````````````````````
*/

/*
|``````````````````````````````````````````````````````````````````````````````````````````````````````````````````
| BEGIN APP BOOTSTRAP
|``````````````````````````````````````````````````````````````````````````````````````````````````````````````````
*/

/**
 * Fetch app functions from bootstrap directory
 */
require_once dirname(__DIR__) . "/app/boot/services.php";

/**
 * Begin autoload service
 */
autoload();
/*
|``````````````````````````````````````````````````````````````````````````````````````````````````````````````````
| END APP BOOTSTRAP
|``````````````````````````````````````````````````````````````````````````````````````````````````````````````````
*/

/*
|```````````````````````````````````````````````````````````````````````````````````````````````````````````````````
| BEGIN ROUTER SERVICE CONFIGURATION
|```````````````````````````````````````````````````````````````````````````````````````````````````````````````````
*/

/**
 * @todo Create a method that registers the default time 
 * zone for different time zones
 */
date_default_timezone_set("Africa/Nairobi");


/**
 * Set Errormode to verbose for development environments 
 * @todo Create a dynamic error handler that configures the 
 * error mode for the application based on env configuration
 */
Data::factory(Error::class)->reportErrors();

/**
 * Get Default landing page
 */
getDefaultLandingPage();

/**
 * Get Route Service Handlers
 */
getRouteServiceHandlers();
/*
|```````````````````````````````````````````````````````````````````````````````````````````````````````````````````
| END ROUTER SERVICE CONFIGURATION
|```````````````````````````````````````````````````````````````````````````````````````````````````````````````````
*/

/**
 * DENY ALL ACCESS TO UNREGISTERED ROUTES
 * This last bit of code should be the
 * last statemant in this script.
 * It checks for all defined routes and 
 * compares them to the URI supplied in the
 * client browser. All unregistered routes
 * will return a 404 error.
 */
Route::denyAllInvalid();



/*
 ```````````````````````````````````````````````````````````````````````````````````````````````````````````````````
 END ROUTER SERVICE PROVIDER
 ```````````````````````````````````````````````````````````````````````````````````````````````````````````````````
 */


?>