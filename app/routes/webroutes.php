<?php

use Vendor\Services\Config\Classes\AppConfig;
use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Data\Data;
use Vendor\Services\File\File;
use Vendor\Services\Routes\Route;
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


/**
 * Defines route to homepage
 */
Route::get("home", function () {
    return File::require("app/views/pages/home.php");
});



/**
 * Defines route to about page
 */
Route::get("about", function () {
    echo "Welcome Home";
});

/**
 * Defines route to contact page
 */
Route::get("contacts", function () {
    echo "Give us a call";
});


Route::get("services", function () {
    echo "This is what we offer";
});

Route::get(Configuration::app("root-directory"), function () {
    return File::require("app/views/pages/home.php");
});

Route::get("product", function () {
    echo "Welcome" . $_GET["id"];
});

Route::get("resource-not-found", function () {
    return File::require("app/views/pages/error.php");
});

Route::get("sandbox", function () {
    return File::require("app/views/pages/sandbox.php");
});

Route::get("test", function () {
    return File::require("app/views/pages/test.php");
});


Route::get("reports", function () {
    return File::require("app/views/pages/reports.php");
});

Route::get("client-registration", function () {
    File::require("app/views/pages/form.php");
});


Route::post("client-registration-form", function () {
    $validation = new Validation(
        $_POST,
        [
            "firstname" => "required:true|min:2|max:30|pattern:letters only",
            "lastname" => "required:true|min:2|max:30|pattern:letters only",
            "gender" => "required:true|values:[Male,Female]",
            "occupation" => "required:true|values:[Student,Employed,Self-employed]",
            "phonenumber" => "required:true|min:10|max:13|pattern:numbers only|unique:true|database:test|table:users|column:phonenumber",
            "email" => "required:true|filter:email|unique:true|database:test|table:users|column:email"
        ],

        [
            "firstname" => [
                "required" => "Your firstname is required",
                "min" => "Your firstname cannot be shorter than 2 letters",
                "max" => "Your firstname cannot be more than 30 letters",
                "pattern" => "Your firstname contains invalid characters. Only letters allowed",
            ],
            "lastname" => [
                "required" => "Your lastname is required",
                "min" => "Your lastname cannot be shorter than 2 letters",
                "max" => "Your lastname cannot be more than 30 letters",
                "pattern" => "Your lastname contains invalid characters. Only letters allowed",
            ],
            "gender" => [
                "required" => "Your gender is required",
                "values" => "Gender field contains an invalid value",
            ],
            "occupation" => [
                "required" => "Your occupation is required",
                "values" => "Occupation field contains an invalid value"
            ],
            "phonenumber" => [
                "required" => "Your phone number is required",
                "min" => "Your phone number is invalid",
                "max" => "Your phone number is invalid",
                "pattern" => "Your phone number contains invalid value. Only numbers allowed",
                "unique" => "Your phone number has already been registered",
            ],
            "email" => [
                "required" => "Your email address is required",
                "filter" => "Invalid email address",
                "unique" => "Email address has already been registered"
            ]
        ]
    );

    if ($validation->passed()) {
        die("true");
    } else {
        echo Data::jsonEncode(["message" => $validation->displayError(), "flag" => 0]);
    }
});