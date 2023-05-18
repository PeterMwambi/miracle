<?php

use Models\Auth\Input;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;


require_once(Url::getPath("app/views/includes/components/renders/renders.php"));

Session::start();

Page::runAuth(
    [
        "attendant-home",
        "attendant-bookings",
        "attendant-payments",
        "attendant-services",
        "attendant-clients"
    ],
    "ATTENDANT_ACCOUNT_ACCESS",
    "ATTENDANT_USER_AUTH",
    "attendant-login"
);


runAttendantPageSetUp();


?>