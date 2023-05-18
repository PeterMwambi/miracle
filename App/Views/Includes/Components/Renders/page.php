<?php

use Models\Auth\Input;
use Models\Auth\Sanitize;
use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Database\Queries\Read\Student;
use Models\Core\App\Utilities\Session;
use Views\Includes\Components\Classes\Page;


/*
```````````````````````````````````````````````````````````
PAGE DEFAULT PROPERTIES
```````````````````````````````````````````````````````````
*/

/**
 * Page setup defaults
 * @param Page $page
 * @return void
 */
function runPageSetupDefaults(Page $page)
{
    $page->setMeta("app/views/includes/meta/head.php");
    $page->setScripts("app/views/includes/meta/scripts.php");
}



/*
```````````````````````````````````````````````````````````
ADMIN PAGE SETUP
```````````````````````````````````````````````````````````
*/

/**
 * Admin page setup
 * @return void
 */

function runAdminPageSetup()
{
    $page = new Page;
    runPageSetupDefaults($page);
    $page->setSpecialRequests([
        "admin-login",
        "admin-registration",
        "admin-service-registration",
        "admin-attendant-registration"
    ]);
    $views = "app/views/includes/containers/admin/views.php";
    $forms = "app/views/includes/containers/admin/forms.php";
    $page->setPages([
        "admin-home" => $views,
        "admin-login" => $forms,
        "admin-registration" => $forms,
        "admin-attendant-registration" => $forms,
        "admin-service-registration" => $forms,
        "admin-payments" => $views,
        "admin-clients" => $views,
        "admin-attendants" => $views,
        "admin-administrators" => $views,
        "admin-bookings" => $views,
        "admin-services" => $views,
    ]);
    $page->setAction("page");
    $page->runSetup();
}
/**
 * Admin views handler
 * @return void
 */
function runAdminViewsHandler()
{
    $page = new Page;
    $page->setPageHandlers([
        "admin-home" => "runAdminHomepageSectionSetup",
        "admin-payments" => "runAdminViewPaymentsSectionSetup",
        "admin-clients" => "runAdminViewClientsSectionSetup",
        "admin-attendants" => "runAdminViewAttendantsSectionSetup",
        "admin-administrators" => "runAdminViewAdministratorsSectionSetup",
        "admin-bookings" => "runAdminViewBookingsSectionSetup",
        "admin-services" => "runAdminViewServicesSectionSetup",
    ]);
    $page->setAction("handler");
    $page->runSetup();
}
/**
 * Admin form handler
 * @return void
 */
function runAdminFormHandler()
{
    $page = new Page;
    $page->setPageHandlers([
        "admin-registration" => "runAdminRegistrationFormSectionSetup",
        "admin-login" => "runAdminLoginFormSectionSetup",
        "admin-service-registration" => "runAdminServiceRegistrationFormSectionSetup",
        "admin-attendant-registration" => "runAdminAttendantRegistrationFormSectionSetup",
    ]);
    $page->setAction("handler");
    $page->runSetup();
}

/*
````````````````````````````````````````````````````````````
ATTENDANT PAGE SETUP
````````````````````````````````````````````````````````````
*/

/**
 * Attendant page setup
 * @return void
 */
function runAttendantPageSetup()
{
    $page = new Page;
    runPageSetupDefaults($page);
    $page->setSpecialRequests([
        "attendant-registration",
        "attendant-login",
    ]);
    $views = "app/views/includes/containers/attendant/views.php";
    $forms = "app/views/includes/containers/attendant/forms.php";
    $page->setPages([
        "attendant-home" => $views,
        "attendant-login" => $forms,
        "attendant-services" => $views,
        "attendant-payments" => $views,
        "attendant-clients" => $views,
        "attendant-bookings" => $views
    ]);
    $page->setAction("page");
    $page->runSetup();
}


/**
 * Attendant form handler
 * @return void
 */
function runAttendantFormHandler()
{
    $page = new Page;
    $page->setPageHandlers([
        "attendant-login" => "runAttendantLoginFormSectionSetup",

    ]);
    $page->setAction("handler");
    $page->runSetup();
}

/**
 * Attendant views handler
 * @return void
 */
function runAttendantViewsHandler()
{
    $page = new Page;
    $page->setPageHandlers([
        "attendant-home" => "runAttendantHomepageSectionSetup",
        "attendant-services" => "runAttendantViewServicesSectionSetup",
        "attendant-payments" => "runAttendantViewPaymentsSectionSetup",
        "attendant-bookings" => "runAttendantViewBookingsSectionSetup",
        "attendant-clients" => "runAttendantViewClientsSectionSetup"
    ]);
    $page->setAction("handler");
    $page->runSetup();
}


/*
````````````````````````````````````````````````````````````
CLIENT PAGE SETUP
````````````````````````````````````````````````````````````
*/
/**
 * Client page setup
 * @return void
 */
function runClientPageSetup()
{
    $page = new Page;
    runPageSetupDefaults($page);
    $page->setSpecialRequests([
        "client-registration",
        "client-login"
    ]);
    $forms = "app/views/includes/containers/client/forms.php";
    $views = "app/views/includes/containers/client/views.php";
    $page->setPages([
        "home" => $views,
        "client-login" => $forms,
        "client-registration" => $forms,
        "client-home" => $views,
        "client-payment" => $forms,
        "client-payments" => $views,
        "client-services" => $views,
        "client-bookings" => $views,
        "client-booking" => $forms,
        "client-discounts" => $views
    ]);
    $page->setAction("page");
    $page->runSetup();
}

/**
 * Client views handler
 * @return void
 */
function runClientViewsHandler()
{
    $page = new Page;
    $page->setPageHandlers([
        "client-home" => "runClientHomepageSectionSetup",
        "client-payments" => "runClientViewPaymentsSectionSetup",
        "client-services" => "runClientViewServicesSectionSetup",
        "client-bookings" => "runClientViewBookingsSectionSetup",
        "client-discounts" => "runClientViewDiscountsSectionSetup"
    ]);
    $page->setAction("handler");
    $page->runSetup();
}

/**
 * Client form handler
 * @return void
 */
function runClientFormHandler()
{
    $page = new Page;
    $page->setPageHandlers([
        "client-registration" => "runClientRegistrationFormSectionSetup",
        "client-login" => "runClientLoginFormSectionSetup",
        "client-payment" => "runClientPaymentFormSectionSetup",
        "client-booking" => "runClientBookingFormSectionSetup"
    ]);
    $page->setAction("handler");
    $page->runSetup();
}



/*
```````````````````````````````````````````````````````````
ON PAGE FUNCTIONS
```````````````````````````````````````````````````````````
*/


function getServices()
{
    $admin = new Admin;
    return $admin->getServices();
}

function getAttendantName(string $atId)
{
    $admin = new Admin;
    return $admin->getAttendantName($atId);
}

function readAdmin()
{
    $admin = new Admin;
    return $admin;
}

function processClientBooking()
{
    if (Input::get("sid")) {
        if (!session::exists("CLIENT_ACCOUNT_ACCESS")) {
            Session::set("prompt-login", true);
            header("location: client-login");
        } else {
            Session::set("sid", Sanitize::string(Input::get("sid")));
            header("location: client-booking");
        }
    }
}