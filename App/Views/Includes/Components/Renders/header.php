<?php

use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Database\Queries\Read\Attendant;
use Models\Core\App\Database\Queries\Read\Client;
use Models\Core\App\Database\Queries\Read\Student;
use Models\Core\App\Database\Queries\Read\Tutor;
use Models\Core\App\Helpers\DateTime;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Header;



function runAdminHomePageHeaderSetup()
{
    $header = new Header;
    $header->setHeading("Hi " . Admin::run()->getFirstname(Session::get("ad_username")) . ",");
    $header->setWelcomeText("Welcome to the administrators dashboard.");
    $header->setDate("Today is " . DateTime::date());
    $header->setLoginInfo("<span class='text-muted'>Last logged in:</span> " . Admin::run()->getLoginTime(Session::get("ad_username")));
    $header->setItemCountHeading("<span class='text-muted'>Total number of tables</span>");
    $header->setItemCount("12");
    $header->setType("profile-header");
    $header->runSetup();
}

function runTutorHomePageHeaderSetup()
{
    $header = new Header;
    $header->setHeading("Hi " . Attendant::run()->getFirstname(Session::get("at_username")) . ",");
    $header->setWelcomeText("Welcome to the tutors dashboard.");
    $header->setDate("Today is " . DateTime::date());
    $header->setLoginInfo("<span class='text-muted'>Last logged in:</span> " . Attendant::run()->getLoginTime(Session::get("t_username")));
    $header->setType("profile-header");
    $header->runSetup();
}

function runClientHomePageHeaderSetup()
{
    $header = new Header;
    $header->setHeading("Hi " . Client::run()->getFirstname(Session::get("cl_username")) . ",");
    $header->setWelcomeText("Welcome to the clients dashboard.");
    $header->setDate("Today is " . DateTime::date());
    $header->setLoginInfo("<span class='text-muted'>Last logged in:</span> " . Client::run()->getLoginTime(Session::get("cl_username")));
    $header->setType("profile-header");
    $header->runSetup();
}


function runClientViewServicesHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/plant.png"));
    $header->setHeading("My services");
    $header->setItemCountHeading("Total number of received and paid services");
    if (is_array(Client::run()->getServices(Session::get("cl_username")))) {
        $header->setItemCount(count(Client::run()->getServices(Session::get("cl_username"))));
    }
    $header->setType("views-header");
    $header->runSetup();
}

function runClientViewBookingsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/phone.png"));
    $header->setHeading("Bookings");
    $header->setItemCountHeading("Total number of bookings");
    if (is_array(Client::run()->getBookings(Session::get("cl_username")))) {
        $header->setItemCount(count(Client::run()->getBookings(Session::get("cl_username"))));
    }
    $header->setHasButton(true);
    $header->setButtonContent([
        "Active bookings",
        "Complete bookings"
    ]);
    $header->setButtonContentClasses([
        "Active bookings" => "btn btn-dark me-3",
        "Complete bookings" => "btn btn-secondary"
    ]);
    $header->setButtonContentLinks([
        "Active bookings" => "?bstatus=active",
        "Complete bookings" => "?bstatus=complete"
    ]);
    $header->setType("views-header");
    $header->runSetup();
}

function runClientViewPaymentsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/dollar.png"));
    $header->setHeading("Payments");
    $header->setItemCountHeading("Total number of payments");
    if (is_array(Client::run()->getPayments(Session::get("cl_username")))) {
        $header->setItemCount(count(Client::run()->getPayments(Session::get("cl_username"))));
    }
    $header->setType("views-header");
    $header->runSetup();
}


function runClientViewDiscountsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/payment-method.png"));
    $header->setHeading("Discounts");
    $header->setItemCountHeading("Total number of discounts");
    if (is_array(Client::run()->getDiscounts(Session::get("cl_username")))) {
        $header->setItemCount(count(Client::run()->getDiscounts(Session::get("cl_username"))));
    }
    $header->setHasButton(true);
    $header->setButtonContent([
        "Active discounts",
        "Redeemed discounts"
    ]);
    $header->setButtonContentClasses([
        "Active discounts" => "btn btn-dark me-3",
        "Redeemed discounts" => "btn btn-secondary"
    ]);
    $header->setButtonContentLinks([
        "Active discounts" => "?dstatus=active",
        "Redeemed discounts" => "?dstatus=redeemed"
    ]);
    $header->setType("views-header");
    $header->runSetup();
}

function runAdminViewClientsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/beauty-treatment.png"));
    $header->setHeading("Clients");
    $header->setItemCountHeading("Total number of clients");
    if (is_array(Admin::run()->getClients())) {
        $header->setItemCount(count(Admin::run()->getClients()));
    }
    $header->setType("views-header");
    $header->runSetup();
}

function runAdminViewAttendantsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/team.png"));
    $header->setHeading("Attendants");
    $header->setItemCountHeading("Total number of Attendants");
    if (is_array(Admin::run()->getAttendants())) {
        $header->setItemCount(count(Admin::run()->getAttendants()));
    }
    $header->setType("views-header");
    $header->runSetup();
}

function runAdminViewAdministratorsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/software-engineer.png"));
    $header->setHeading("Administrators");
    $header->setItemCountHeading("Total number of administrators");
    if (is_array(Admin::run()->getAdministrators())) {
        $header->setItemCount(count(Admin::run()->getAdministrators()));
    }
    $header->setType("views-header");
    $header->runSetup();
}


function runAdminViewServicesHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/plant.png"));
    $header->setHeading("Services");
    $header->setItemCountHeading("Total number of services");
    if (is_array(Admin::run()->getServices())) {
        $header->setItemCount(count(Admin::run()->getServices()));
    }
    $header->setType("views-header");
    $header->runSetup();
}

function runAdminViewPaymentsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/dollar.png"));
    $header->setHeading("Payments");
    $header->setItemCountHeading("Total number of payments");
    if (is_array(Admin::run()->getPayments())) {
        $header->setItemCount(count(Admin::run()->getPayments()));
    }
    $header->setType("views-header");
    $header->runSetup();
}

function runAdminViewBookingsHeaderSetup()
{
    $header = new Header;
    $header->setHeadingIcon(Url::getReference("resources/assets/images/png/phone.png"));
    $header->setHeading("Bookings");
    $header->setItemCountHeading("Total number of bookings");
    if (is_array(Admin::run()->getBookings())) {
        $header->setItemCount(count(Admin::run()->getBookings()));
    }
    $header->setType("views-header");
    $header->runSetup();
}