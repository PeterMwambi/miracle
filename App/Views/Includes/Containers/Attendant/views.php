<?php

use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;

require_once(Url::getPath("app/views/includes/components/renders/renders.php"));

if (Session::exists("t_username")) {
    runAttendantNavbarSetUp(Page::run()->getTitle());
} else {
    runDefaultNavbarSetUp(Page::run()->getTitle());
}

runAttendantViewsHandler();

?>