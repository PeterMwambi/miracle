<?php

use Vendor\Services\Authentication\Sessions\Classes\SessionServiceProvider;

function getUser($bio)
{
    foreach ($bio as $key => $value):
        echo ucfirst($key) . ": " . $value . "\n";
    endforeach;
}


$profile = [
    "bio" => [
        //array keys must be parameters of the function
        "name" => "Peter Mwambi",
        "gender" => "Male",
        "age" => "22",
        "date-of-birth" => "1/12/2000",
        "username" => "pmwambi",
        "email" => "calebmwambi@gmail.com",
        "phone-number" => "0700521998"
    ]
];

call_user_func_array("getUser", $profile);

$func = "str_replace";

$currentFile = array("\\", "/", __FILE__);

$result = call_user_func_array($func, $currentFile);

echo $result;