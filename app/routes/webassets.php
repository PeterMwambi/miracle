<?php

use Vendor\Services\File\File;
use Vendor\Services\Routes\Route;


/**
 * ````````````````````````````````````````````````````````````````````````````````````````````````
 * CSS Files
 * ````````````````````````````````````````````````````````````````````````````````````````````````
 */
Route::get("bootstrap.css", function () {
    header("Content-type:text/css");
    return File::require("app/resources/css/frameworks/bootstrap.min.css");
});

Route::get("style.css", function () {
    header("Content-type:text/css");
    return File::require("app/resources/css/custom/style.css");
});

Route::get("root.css", function () {
    header("Content-type:text/css");
    return File::require("app/resources/css/custom/root.css");
});

Route::get("darktheme.css", function () {
    header("Content-type:text/css");
    return File::require("app/resources/css/custom/darktheme.css");
});

/**
 * ````````````````````````````````````````````````````````````````````````````````````````````````
 * JS Files
 * ````````````````````````````````````````````````````````````````````````````````````````````````
 */

Route::get("bootstrap.js", function () {
    header("Content-type:application/javascript");
    return File::require("app/resources/js/frameworks/bootstrap.js");
});

Route::get("dpz.js", function () {
    header("Content-type:application/javascript");
    return File::require("app/resources/js/custom/dpz.js");
});

Route::get("test.js", function () {
    header("Content-type:text/js");
    return File::require("app/resources/js/custom/test.js");
});

Route::get("dpzexecute.js", function () {
    header("Content-type:text/js");
    return File::require("app/resources/js/custom/dpzexecute.js");
});

Route::get("jquery.js", function () {
    header("Content-type:text/js");
    return File::require("app/resources/js/frameworks/jquery.js");
});

/**
 * ````````````````````````````````````````````````````````````````````````````````````````````````
 * PNG Files
 * ````````````````````````````````````````````````````````````````````````````````````````````````
 */

Route::get("miracle.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/logo/miracle.png");
});

Route::get("dpz.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/logo/dpz.png");
});

Route::get("rmis.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/logo/rmis.png");
});

Route::get("darkmode.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/dark-mode.png");
});

Route::get("lightmode.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/light-mode.png");
});

Route::get("favicon.ico", function () {
    header("Content-type:image/png");
    return File::require("favicon.ico");
});

Route::get("open.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/open.png");
});

Route::get("dashboard.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/dashboard.png");
});

Route::get("todo.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/todo.png");
});

Route::get("notifications.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/notifications.png");
});

Route::get("message.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/messaging.png");
});

Route::get("properties.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/properties.png");
});

Route::get("tenants.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/tenants.png");
});

Route::get("payments.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/payments.png");
});

Route::get("invoice.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/invoice.png");
});

Route::get("receipts.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/receipts.png");
});

Route::get("reports.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/reports.png");
});

Route::get("package.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/package.png");
});

Route::get("occupation.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/occupation.png");
});

Route::get("vacation.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/vacation.png");
});

Route::get("settings.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/services.png");
});

Route::get("profile.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/profile.png");
});

Route::get("logout.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/switch.png");
});

Route::get("close.png", function () {
    header("Content-type:image/png");
    return File::require("app/resources/assets/ui/close.png");
});