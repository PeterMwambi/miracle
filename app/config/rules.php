<?php


define("RULE_CONFIGURATION_SETTINGS", [
    "client-registration-form" => [
        "firstname" => "required:true|min:2|max:30|pattern:letters only",
        "lastname" => "required:true|min:2|max:30|pattern:letters only",
        "gender" => "required:true|values:[Male,Female]",
        "occupation" => "required:true|values:[Student,Employed,Self-employed]",
        "phonenumber" => "required:true|min:10|max:13|pattern:numbers only|unique:true|database:test|table:users|column:phonenumber",
        "email" => "required:true|filter:email|unique:true|database:test|table:users|column:email"
    ]
]);