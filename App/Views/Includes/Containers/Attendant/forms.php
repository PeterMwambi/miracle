<?php

use Models\Core\App\Cache\Storage;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;

require_once(Url::getPath("app/views/includes/components/renders/renders.php"));
Storage::clearCache();

if (Session::exists("at_username")) {
    runAttendantNavbarSetUp(Page::run()->getTitle());
} else {
    runDefaultNavbarSetUp(Page::run()->getTitle());
}

runAttendantFormHandler();
?>