<?php

use Models\Auth\Input;
use Models\Auth\Sanitize;
use Models\Core\App\Utilities\Session;
use Views\Includes\Components\Classes\Section;


/*
```````````````````````````````````````````````````````````````````````
SECTION DEFAULTS
```````````````````````````````````````````````````````````````````````
*/
/**
 * Section setup defaults
 * @param Section $section
 * @return void
 */
function sectionSetupDefaults(Section $section)
{
    $section->setSectionClasses("container-fluid mt-lg");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

/**
 * Views section setup defaults
 * @param Section $section
 * @return void
 */
function viewsSectionSetupDefaults(Section $section)
{
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "col-md-12 col-12",
        "views-body" => "col-md-12 col-12"
    ]);
}


/**
 * Registration form section setup defaults
 * @param Section $section
 * @return void
 */
function registrationFormSectionSetupDefaults(Section $section)
{
    $section->setRowSizing("mt-3");
    $section->setRows(["form-description", "form-body"]);
    $section->setCols([
        "form-description" => "col-md-6 my-5",
        "form-body" => "col-md-5 my-5"
    ]);
}

/**
 * Login form section setup defaults
 * @param Section $section
 * @return void
 */
function loginFormSectionSetupDefaults(Section $section)
{
    $section->setRowSizing("mt-3");
    $section->setRows(["form-description", "form-body"]);
    $section->setCols([
        "form-description" => "col-md-7 my-5",
        "form-body" => "col-md-4 my-5"
    ]);
}


/*
`````````````````````````````````````````````````````````````````
ATTENDANT SECTION SETUP
````````````````````````````````````````````````````````````````
*/
/**
 * Attendant homepage setup
 * @return void
 */
function runAttendantHomepageSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "row"
    ]);
    $section->setContent([
        "views-header" => [
            "runAttendantHomepageHeaderSetup"
        ],
        "views-body" => [
            "runAttendantHomepageSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

/**
 * Attendant registration form section setup
 * @return void
 */
function runAdminAttendantRegistrationFormSectionSetup()
{
    $section = new Section;
    registrationFormSectionSetupDefaults($section);
    $section->setContent([
        "form-description" => [
            "runAttendantRegistrationFormDescriptionSetup"
        ],
        "form-body" => [
            "runProgressBarSetup",
            "runAttendantRegistrationFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}

/**
 * Attendant login form section setup
 * @return void
 */
function runAttendantLoginFormSectionSetup()
{
    $section = new Section;
    loginFormSectionSetupDefaults($section);
    $section->setContent([
        "form-description" => [
            "runAttendantLoginFormDescriptionSetup"
        ],
        "form-body" => [
            "runAttendantLoginFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}

/**
 * Attendant view services section setup
 * @return void
 */
function runAttendantViewServicesSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAttendantViewServicesHeaderSetup"
        ],
        "views-body" => [
            "runAttendantViewServicesSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}


function runAttendantViewPaymentSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runTutorViewPaymentsHeaderSetup"
        ],
        "views-body" => [
            "runTutorViewPaymentsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runAttendantViewClientsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAttendantViewClientsHeaderSetup"
        ],
        "views-body" => [
            "runAttendantViewClientsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runAttendantViewBookingsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAttendantViewBookingsHeaderSetup"
        ],
        "views-body" => [
            "runAttendantViewBookingsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

/*
`````````````````````````````````````````````````````````````````````
CLIENT SECTION SETUP
`````````````````````````````````````````````````````````````````````
*/

function runClientHomepageSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "row"
    ]);
    $section->setContent([
        "views-header" => [
            "runClientHomepageHeaderSetup"
        ],
        "views-body" => [
            "runClientHomepageSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

/**
 * Client registration form section setup
 * @return void
 */
function runClientRegistrationFormSectionSetup()
{
    $section = new Section;
    registrationFormSectionSetupDefaults($section);
    $section->setContent([
        "form-description" => [
            "runClientRegistrationFormDescriptionSetup"
        ],
        "form-body" => [
            "runProgressBarSetup",
            "runClientRegistrationFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}

/**
 * Client login form section setup
 * @return void
 */
function runClientLoginFormSectionSetup()
{
    $section = new Section;
    loginFormSectionSetupDefaults($section);
    $alert = "";
    if (Session::exists("prompt-login")) {
        $alert = "runServiceBookingAlertSetUp";
        Session::destroy("prompt-login");
    }
    $section->setContent([
        "form-description" => [
            "runClientLoginFormDescriptionSetup"
        ],
        "form-body" => [
            $alert,
            "runClientLoginFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}

function runClientPaymentFormSectionSetup()
{
    if (Input::get("bkid") && Input::get("atid") && Input::get("price") && Input::get("sid")) {
        Session::set("bkid", Sanitize::string(Input::get("bkid")));
        Session::set("atid", Sanitize::string(Input::get("atid")));
        Session::set("price", Sanitize::string(Input::get("price")));
        Session::set("sid", Sanitize::string(Input::get("sid")));
    }
    $section = new Section;
    registrationFormSectionSetupDefaults($section);
    $alert = "";
    if (Session::exists("sid")) {
        $alert = "runClientServicePaymentAlertSetup";
    }
    $section->setContent([
        "form-description" => [
            "runClientPaymentFormDescriptionSetup"
        ],
        "form-body" => [
            $alert,
            "runClientPaymentFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}


function runClientViewPaymentsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runClientViewPaymentsHeaderSetup"
        ],
        "views-body" => [
            "runClientViewPaymentsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runClientViewDiscountsSectionSetup()
{
    $section = new Section;
    $alert = "";
    if (Input::get("did") && Input::get("action") === "redeem") {
        Session::set("did", Input::get("did"));
        $alert = "runDiscountAlertSetUp";
    }
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runClientViewDiscountsHeaderSetup",
        ],
        "views-body" => [
            $alert,
            "runClientViewDiscountsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}


function runClientViewBookingsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runClientViewBookingsHeaderSetup"
        ],
        "views-body" => [
            "runClientViewBookingsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

/**
 * Client view services section setup
 * @return void
 */
function runClientViewServicesSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runClientViewServicesHeaderSetup"
        ],
        "views-body" => [
            "runClientViewServicesSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}


/**
 * Client booking form section setup
 * @return void
 */
function runClientBookingFormSectionSetup()
{
    $section = new Section;
    loginFormSectionSetupDefaults($section);
    $alert = "";
    if (Session::exists("sid")) {
        $alert = "runClientServicePaymentAlertSetup";
    }
    $section->setContent([
        "form-description" => [
            "runClientBookingFormDescriptionSetup"
        ],
        "form-body" => [
            $alert,
            "runClientBookingFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}

/*
`````````````````````````````````````````````````````````````````````
ADMIN SECTION SETUP
`````````````````````````````````````````````````````````````````````
*/

/**
 * Student registration form section setup
 * @return void
 */
function runAdminRegistrationFormSectionSetup()
{
    $section = new Section;
    registrationFormSectionSetupDefaults($section);
    $section->setContent([
        "form-description" => [
            "runAdminRegistrationFormDescriptionSetup"
        ],
        "form-body" => [
            "runProgressBarSetup",
            "runAdminRegistrationFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}

/**
 * Admin login form section setup
 * @return void
 */
function runAdminLoginFormSectionSetup()
{
    $section = new Section;
    loginFormSectionSetupDefaults($section);
    $section->setContent([
        "form-description" => [
            "runAdminLoginFormDescriptionSetup"
        ],
        "form-body" => [
            "runAdminLoginFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}

/**
 * Admin service registration form section setup
 * @return void
 */
function runAdminServiceRegistrationFormSectionSetup()
{
    $section = new Section;
    registrationFormSectionSetupDefaults($section);
    $section->setContent([
        "form-description" => [
            "runAdminServiceRegistrationFormDescriptionSetup"
        ],
        "form-body" => [
            "runAdminServiceRegistrationFormCardSetup"
        ]
    ]);
    sectionSetupDefaults($section);
}
/**
 * Admin homepage setup
 * @return void
 */
function runAdminHomepageSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "row"
    ]);
    $section->setContent([
        "views-header" => [
            "runAdminHomepageHeaderSetup"
        ],
        "views-body" => [
            "runAdminHomepageSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

/**
 * Summary of runAdminViewStudentsSectionSetup
 * @return void
 */
function runAdminViewClientsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAdminViewClientsHeaderSetup"
        ],
        "views-body" => [
            "runAdminViewClientsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runAdminViewAttendantsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAdminViewAttendantsHeaderSetup"
        ],
        "views-body" => [
            "runAdminViewAttendantsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runAdminViewAdministratorsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAdminViewAdministratorsHeaderSetup"
        ],
        "views-body" => [
            "runAdminViewAdministratorsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runAdminViewBookingsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAdminViewBookingsHeaderSetup"
        ],
        "views-body" => [
            "runAdminViewBookingsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runAdminViewServicesSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAdminViewServicesHeaderSetup"
        ],
        "views-body" => [
            "runAdminViewServicesSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}

function runAdminViewPaymentsSectionSetup()
{
    $section = new Section;
    $section->setRows(["views-header", "views-body"]);
    $section->setCols([
        "views-header" => "row",
        "views-body" => "col-md-12 col-12"
    ]);
    $section->setContent([
        "views-header" => [
            "runAdminViewPaymentsHeaderSetup"
        ],
        "views-body" => [
            "runAdminViewPaymentsSetup"
        ]
    ]);
    $section->setSectionClasses("container-fluid mt-md");
    $section->setHasRows(true);
    $section->setType("default");
    $section->runSetup();
}