<?php

use Models\Auth\Input;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;


require_once(Url::getPath("app/views/includes/components/renders/renders.php"));

Session::start();

Page::runAuth(
    [
        "client-payments",
        "client-home",
        "client-payment",
        "client-services",
        "client-bookings",
        "client-booking"
    ],
    "CLIENT_ACCOUNT_ACCESS",
    "CLIENT_USER_AUTH",
    "client-login"
);


runClientPageSetUp();


?>