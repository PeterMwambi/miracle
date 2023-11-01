<?php

use App\Controllers\ConfigurationController as Config;
use Vendor\Services\Data\Data;
use Vendor\Services\Routes\Route;
use Vendor\Services\Server\Server;
use Vendor\Services\Validation\Validation;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Sat May 27 2023 03:13:45 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Registers all web routes 
 */

/**
 * REGISTER ALL WEB ROUTES
 * This is the section where you define 
 * all routes to pages, views or forwarders
 * such as form submission handlers.
 * Route methods include get, and post
 */



Route::get("home", function () {
    return view("app/views/pages/home.php");
});


Route::get("test", function () {
    return view("app/views/pages/test.php");
});


Route::post("client-registration-form", function () {
    $validation = new Validation(
        $_POST,
        Config::rules("client-registration-form"),
        Config::errors("client-registration-form")
    );

    if ($validation->passed()) {
        die("true");
    } else {
        Server::httpResponseCode(404);
        echo Data::jsonEncode(["message" => $validation->displayError(), "flag" => 0]);
    }
});