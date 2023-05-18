<?php

use Models\Core\App\Cache\Storage;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Page;

require_once(Url::getPath("app/views/includes/components/renders/renders.php"));
Storage::clearCache();

if (Session::exists("cl_username")) {
    runClientNavbarSetUp(Page::run()->getTitle());
} else {
    runDefaultNavbarSetup(Page::run()->getTitle());
}



runClientFormHandler();
?>