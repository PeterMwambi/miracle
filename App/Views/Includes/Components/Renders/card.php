<?php

use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Database\Queries\Read\Attendant;
use Models\Core\App\Database\Queries\Read\Client;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Card;


/**
 * Form card setup defaults
 * @param Card $card
 * @return void
 */
function formSetupDefaults(Card $card)
{
    $card->setCardSizing("my-5");
    $card->setCardBodySizing("p-4");
    $card->setType("default");
    $card->runSetup();
}

/**
 * Attendant Registration form card setup
 * @return void
 */
function runAttendantRegistrationFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runAttendantRegistrationFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runAttendantRegistrationFormSetupStep2", "runattendantRegistrationFormSetupStep1"]);
    formSetupDefaults($card);
}

/**
 * Attendant login form card setup
 * @return void
 */
function runAttendantLoginFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runAttendantLoginFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runAttendantLoginFormSetup"]);
    formSetupDefaults($card);
}

/**
 * Client registration form card setup
 * @return void
 */
function runClientRegistrationFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runClientRegistrationFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runClientRegistrationFormSetupStep2", "runClientRegistrationFormSetupStep1"]);
    formSetupDefaults($card);
}

/**
 * Client login form card setup
 * @return void
 */
function runClientLoginFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runClientLoginFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runClientLoginFormSetup"]);
    formSetupDefaults($card);
}

/**
 * Client fee payment form card setup
 * @return void
 */
function runClientPaymentFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runClientPaymentFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runClientPaymentFormSetup"]);
    formSetupDefaults($card);
}

/**
 * Client fee payment form card setup
 * @return void
 */
function runClientBookingFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runClientBookingFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runClientBookingFormSetup"]);
    formSetupDefaults($card);
}
/**
 * Admin registration form card setup
 * @return void
 */
function runAdminRegistrationFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runAdminRegistrationFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runAdminRegistrationFormSetupStep2", "runAdminRegistrationFormSetupStep1"]);
    formSetupDefaults($card);
}
/**
 * Admin login form card setup
 * @return void
 */
function runAdminLoginFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runAdminLoginFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runAdminLoginFormSetup"]);
    formSetupDefaults($card);
}
/**
 * Admin Course registration setup
 * @return void
 */
function runAdminServiceRegistrationFormCardSetup()
{
    $card = new Card();
    $card->setCardBodyContent(["runAdminServiceRegistrationFormHeaderSetUp", "runSpinnerSetUp", "runFormAlertSetup"]);
    $card->setHasDiv(true);
    $card->setDivClasses("mt-3");
    $card->setDivContent(["runCompleteSetupAlert", "runAdminServiceRegistrationFormSetupStep1", "runAdminServiceRegistrationFormSetupStep2"]);
    formSetupDefaults($card);
}

/**
 * Client homepage setup
 * @return void
 */
function runAdminHomepageSetup()
{
    $card = new Card;
    $card->setProfileCardItems([
        "Clients",
        "Attendants",
        "Administrators",
        "Bookings",
        "Services",
        "Payments",
    ]);
    $clients = Url::getReference("resources/assets/images/png/beauty-treatment.png");
    $attendants = Url::getReference("resources/assets/images/png/team.png");
    $admin = Url::getReference("resources/assets/images/png/meeting.png");
    $bookings = Url::getReference("resources/assets/images/png/phone.png");
    $services = Url::getReference("resources/assets/images/png/plant.png");
    $payment = Url::getReference("resources/assets/images/png/dollar.png");
    $open = Url::getReference("resources/assets/images/png/open-folder.png");
    $add = Url::getReference("resources/assets/images/png/add.png");
    $card->setProfileCardIcons([
        "Clients" => $clients,
        "Attendants" => $attendants,
        "Administrators" => $admin,
        "Bookings" => $bookings,
        "Services" => $services,
        "Payments" => $payment,
        "View clients" => $open,
        "View attendants" => $open,
        "View admins" => $open,
        "Add admin" => $add,
        "Add attendant" => $add,
        "View services" => $open,
        "View bookings" => $open,
        "Add service" => $add,
        "View payments" => $open,
    ]);
    $card->setProfileCardParagraphs([
        "Clients" => "Consist of registered with user accounts",
        "Attendants" => "Consist of registered service attendants with user accounts",
        "Administrators" => "Consist of administrators with admin accounts",
        "Services" => "Consist of registered services",
        "Bookings" => "Consist of all bookings made by clients",
        "Payments" => "Consist of all payments",
    ]);
    $card->setProfileCardButtons([
        "Clients" => [
            "View clients"
        ],
        "Attendants" => [
            "View attendants",
            "Add attendant"
        ],
        "Administrators" => [
            "View admins",
            "Add admin"
        ],
        "Bookings" => [
            "View bookings"
        ],
        "Services" => [
            "View services",
            "Add service"
        ],
        "Payments" => [
            "View payments"
        ]
    ]);


    $card->setProfileCardButtonProperties([
        "View clients" => "btn btn-primary",
        "View attendants" => "btn btn-primary me-2",
        "Add attendant" => "btn btn-secondary me-2",
        "View admins" => "btn btn-primary me-2",
        "Add admin" => "btn btn-secondary me-2",
        "View bookings" => "btn btn-primary",
        "View services" => "btn btn-primary me-2",
        "Add service" => "btn btn-secondary me-2",
        "View payments" => "btn btn-primary me-2",
    ]);
    $card->setProfileCardButtonLinks([
        "View clients" => "admin-clients",
        "View attendants" => "admin-attendants",
        "Add attendant" => "admin-attendant-registration",
        "View admins" => "admin-administrators",
        "Add admin" => "admin-registration",
        "View bookings" => "admin-bookings",
        "View services" => "admin-services",
        "Add service" => "admin-service-registration",
        "View payments" => "admin-payments",
    ]);
    $card->setItemCountHeading([
        "Clients" => "Total number of clients",
        "Attendants" => "Total number of attendants",
        "Administrators" => "Total number of administrators",
        "Bookings" => "Total number of bookings",
        "Services" => "Total number of services",
        "Payments" => "Total number of payments",
    ]);
    $admin = new Admin;
    $card->setItemCount([
        "Clients" => is_array(readAdmin()->getClients()) ? count(readAdmin()->getClients()) : 0,
        "Attendants" => is_array(readAdmin()->getAttendants()) ? count(readAdmin()->getAttendants()) : 0,
        "Administrators" => is_array(readAdmin()->getAdministrators()) ? count(readAdmin()->getAdministrators()) : 0,
        "Bookings" => is_array([]) ? 0 : 0,
        "Services" => is_array(readAdmin()->getServices()) ? count(readAdmin()->getServices()) : 0,
        "Payments" => is_array([]) ? 0 : 0,
    ]);
    $card->setType("profile-card");
    $card->runSetup();
}

/**
 * Admin homepage setup
 * @return void
 */
function runAttendantHomepageSetup()
{
    $card = new Card;
    $card->setProfileCardItems([
        "Services",
        "Bookings",
        "Payments",
        "Clients"
    ]);
    $bookings = Url::getReference("resources/assets/images/png/phone.png");
    $services = Url::getReference("resources/assets/images/png/plant.png");
    $payment = Url::getReference("resources/assets/images/png/dollar.png");
    $open = Url::getReference("resources/assets/images/png/open-folder.png");
    $card->setProfileCardIcons([
        "Bookings" => $bookings,
        "Services" => $services,
        "Payments" => $payment,
        "View bookings" => $open,
        "View services" => $open,
        "View payments" => $open,
        "View clients" => $open
    ]);
    $card->setProfileCardParagraphs([
        "Bookings" => "Consist of all bookings made to you by clients",
        "Services" => "Consist of all services that you offer",
        "Payments" => "Consist of all payments made to you by clients",
    ]);
    $card->setProfileCardButtons([
        "Bookings" => [
            "View bookings"
        ],
        "Payments" => [
            "View payments"
        ],
        "Services" => [
            "View services",
        ],
        "Clients" => [
            "View clients"
        ]
    ]);


    $card->setProfileCardButtonProperties([
        "View bookings" => "btn btn-primary",
        "View services" => "btn btn-primary",
        "View payments" => "btn btn-primary",
        "View clients" => "btn btn-primary"
    ]);
    $card->setProfileCardButtonLinks([
        "View bookings" => "attendant-bookings",
        "View services" => "attendant-services",
        "View payments" => "attendant-payments",
        "View clients" => "attendant-clients"
    ]);
    $card->setItemCountHeading([
        "Bookings" => "Total number of bookings",
        "Services" => "Total number of services",
        "Payments" => "Total number of payments",
        "Clients" => "Total number of clients",
    ]);
    $card->setItemCount([
        "Bookings" => is_array([]) ? 0 : 0,
        "Services" => is_array([]) ? 0 : 0,
        "Payments" => is_array([]) ? 0 : 0,
        "Clients" => is_array([]) ? 0 : 0
    ]);
    $card->setType("profile-card");
    $card->runSetup();
}

/**
 * Client homepage setup
 * @return void
 */
function runClientHomepageSetup()
{
    $card = new Card;
    $card->setProfileCardItems([
        "Services",
        "Bookings",
        "Payments",
    ]);
    $bookings = Url::getReference("resources/assets/images/png/phone.png");
    $services = Url::getReference("resources/assets/images/png/plant.png");
    $payment = Url::getReference("resources/assets/images/png/dollar.png");
    $open = Url::getReference("resources/assets/images/png/open-folder.png");
    $card->setProfileCardIcons([
        "Services" => $services,
        "Bookings" => $bookings,
        "Payments" => $payment,
        "My services" => $open,
        "My payments" => $open,
        "My bookings" => $open,
    ]);
    $card->setProfileCardParagraphs([
        "Services" => "Consist of all services that you have received",
        "Bookings" => "Consist of all bookings that you have made",
        "Payments" => "Consist of all payments you have made",
    ]);
    $card->setProfileCardButtons([
        "Services" => [
            "My services"
        ],
        "Bookings" => [
            "My bookings",
        ],
        "Payments" => [
            "My payments"
        ]
    ]);


    $card->setProfileCardButtonProperties([
        "My services" => "btn btn-primary",
        "My bookings" => "btn btn-primary me-2",
        "My payments" => "btn btn-primary me-2",
    ]);
    $card->setProfileCardButtonLinks([
        "My services" => "client-services",
        "My bookings" => "client-bookings",
        "My payments" => "client-payments",
    ]);
    $card->setItemCountHeading([
        "Services" => "Total number of services",
        "Bookings" => "Total number of bookings",
        "Payments" => "Total number of payments",
    ]);
    $card->setItemCount([
        "Services" => is_array(Client::run()->getServices(Session::get("cl_username"))) ? count(Client::run()->getServices(Session::get("cl_username"))) : 0,
        "Bookings" => is_array(Client::run()->getBookings(Session::get("cl_username"))) ? count(Client::run()->getBookings(Session::get("cl_username"))) : 0,
        "Payments" => is_array(Client::run()->getPayments(Session::get("cl_username"))) ? count(Client::run()->getPayments(Session::get("cl_username"))) : 0,
    ]);
    $card->setType("profile-card");
    $card->runSetup();
}