<?php

define("ERROR_CONFIGURATION_SETTINGS", [
    "client-registration-form" => [
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
]);