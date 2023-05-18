<?php

use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;


Session::start();

Page::runAuth(
    [
        "admin-service-registration",
        "admin-attendant-registration",
        "admin-registration",
        "admin-home",
        "admin-payments",
        "admin-clients",
        "admin-attendants",
        "admin-payments",
        "admin-bookings",
        "admin-services"
    ],
    "ADMIN_ACCOUNT_ACCESS",
    "ADMIN_USER_AUTH",
    "admin-login"
);


require_once(Url::getPath("app/views/includes/components/renders/renders.php"));


runAdminPageSetup();

?>