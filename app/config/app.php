<?php
/**
 * Contains App Configuration Settings
 */

use Vendor\Services\Validation\Validation;

define(
    "APP_CONFIGURATION_SETTINGS",
    [


        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
        |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
        |``````````````````````````````````````````````````````````````````````````````````````````
       */
        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | BEGIN APP BASIC CONFIGURATION SETTINGS
        |``````````````````````````````````````````````````````````````````````````````````````````
        | WARNING !!!!!
        | DO NOT TOUCH OR MODIFY CONFIGURATIONS IN THIS SECTION
        | UNLESS YOU KNOW WHAT YOU ARE DOING IT MAY CAUSE YOUR APP TO BEHAVE UNEXPECTEDLY
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | DATABASE CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */
        "pdo" => [
            /**
             * Set the PDO connection configuration options.
             */
            "options" => [
                "errmode-development" => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
                "errmode-production" => [PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT],
                "fetch-object" => [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ],
                "fetch-array" => [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            ]
        ],
        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | END DATABASE CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | DIRECTORY CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */
        /**
         * Set root directory
         * - Replace absolute root directory path with relative root path
         * - Replace  back slashes with forward slashes
         */
        "root-directory" => str_replace([dirname(__DIR__, 3), "\\"], ["", "/"], dirname(__DIR__, 2)) . "/",
        /**
         * Set root directory path
         * - Get the absolute root directory path
         */
        "root-directory-path" => str_replace("\\", "/", dirname(__DIR__, 2)),

        /**
         * Set document root
         * - Get the absolute root directory path
         */
        "root-absolute-path" => $_SERVER["DOCUMENT_ROOT"],
        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | END DIRECTORY CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | ROUTES CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        /**
         * Set default route session handler name
         * - The session name that handles all defined routes
         */
        "route-session-handler" => "ROUTE_SERVICE_PROVIDER",

        /**
         * Set the session pass key
         * - The pass key phrase that authenticates access to all sessions
         */
        "route-session-passkey" => "",



        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | END ROUTES CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */
        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | HEADER CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        "content-types" => [
            "html" => "text/html",
            "css" => "text/css",
            "js" => "text/js",
            "json" => "text/json",
            "png" => "image/png",
            "ico" => "image/png",
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg"
        ],

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | END HEADER CONFIGURATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */
        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | END APP BASIC CONFIGURATION SETTINGS
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
        |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
        |``````````````````````````````````````````````````````````````````````````````````````````
        */
        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | BEGIN APP CUSTOMISABLE CONFIGURATION SETTINGS
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | PAGES
        |``````````````````````````````````````````````````````````````````````````````````````````
        */
        /**
         * Set default assets directory
         * - Gets the directory handler for asset folders and files
         * - Asset folders and files include css, js, icons, images folders
         */
        "default-assets-directory" => "app/assets",

        /**
         * Set default error page handler
         * - This configuration sets the default error page URI handler
         */
        "default-error-page" => "app/views/pages/error.php",

        /**
         * Set default landing page
         * - The default landing page for root domain access
         */
        "default-landing-page" => "app/views/pages/home.php",

        /**
         * Set default error route
         * - This configuration sets the default error route
         */
        "default-error-route" => "resource-not-found",

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | END PAGES
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | VALIDATION
        |``````````````````````````````````````````````````````````````````````````````````````````
        */

        "filters" => [
            "email" => FILTER_VALIDATE_EMAIL,
            "ipaddress" => FILTER_VALIDATE_IP,
            "number" => FILTER_VALIDATE_INT,
            "regexp" => FILTER_VALIDATE_REGEXP
        ],

        "patterns" => [
            "letters only" => "/^[A-Za-z]*$/",
            "letters only with spacing" => "/^[A-Za-z ]*$/",
            "letters only with special characters" => "/^[A-Za-z@#+]*$/",
            "letters only with special characters and spacing" => "/^[A-Za-z@#+ ]*$/",
            "letters only uppercase" => "/^[A-Z]*$/",
            "letters only lowercase" => "/^[A-Z]*$/",
            "numbers only" => "/^[0-9]*$/",
            "numbers only with special characters" => "/^[0-9@#+]*$/",
            "letters and numbers" => "/^[A-Za-z0-9]*$/",
            "letters and numbers with spacing" => "/^[A-Za-z0-9 ]*$/",
            "letters and numbers with special characters" => "/^[A-Za-z0-9@#+]*$/",
            "letters and numbers with special characters and spacing" => "/^[A-Za-z0-9@#+ ]*$/"
        ],

        "methods" => [
            "required" => "validateRequired",
            "any" => "validateRequiredAny",
            "count" => "validateCount",
            "min" => "validateMinLength",
            "max" => "validateMaxLength",
            "filter" => "validateWithFilter",
            "pattern" => "validateWithPattern",
            "unique" => "validateWithDatabase"
        ],
        /*
        |``````````````````````````````````````````````````````````````````````````````````````````
        | END APP CUSTOMISABLE CONFIGURATION SETTINGS
        |``````````````````````````````````````````````````````````````````````````````````````````
        */


    ]
);