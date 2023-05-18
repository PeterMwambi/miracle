<?php

use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Database\Queries\Read\Attendant;
use Models\Core\App\Database\Queries\Read\Client;
use Models\Core\App\Database\Queries\Read\Student;
use Models\Core\App\Database\Queries\Read\Tutor;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Navbar;


/**
 * Navbar setup defaults
 * @param Navbar $navbar
 * @return void
 */
function navbarSetUpDefaults(Navbar $navbar)
{
    $navbar->setIsCollapsable(true);
    $navbar->setNavBarVariation("light");
    $navbar->setNavBarColor("light");
    $navbar->setNavBarClasses("p-3 p-md-0 shadow-sm");
    $navbar->setNavBarPositioning("fixed-top");
    $navbar->setNavBrandClasses("mx-2 mt-2");
    $navbar->setNavBrandLink("home");
    $navbar->setNavBrandImageUrl(Url::getReference("resources/assets/icons/dopespa.svg"));
    $navbar->setNavBrandImageClasses("tutors-point__logo");
    $navbar->setNavItemClasses("mx-3");
}
/**
 * Default navbar setup
 * @param string $page
 * @return void
 */
function runDefaultNavbarSetup(string $page)
{
    $navbar = new Navbar;
    $navbar->setCurrentPage($page);
    navbarSetUpDefaults($navbar);
    $navbar->setNavItems([
        "Home",
        "Services",
        "Sign in",
    ]);
    $navbar->setNavLinks([
        "Home" => "home",
        "Services" => "services",
        "Sign in" => "#",
        "Register" => "#"
    ]);
    $navbar->setDropDownItems([
        "Sign in" => [
            "Sign in as client",
            "Sign in as admin"
        ],
    ]);
    $navbar->setDropDownItemsId([
        "Sign in" => "sign-in",
        "Register" => "register",
    ]);
    $navbar->setDropDownItemLinks([
        "Sign in" => [
            "Sign in as client" => "client-login",
            "Sign in as admin" => "admin-login"
        ],
    ]);

    $navbar->setDropdownItemClasses([
        "Sign in" => "left-3 me-5",
    ]);
    $navbar->setSeparator(true);
    $navbar->setSeparatorClasses("me-3");
    $navbar->setNavbarButtons(["Register"]);
    $navbar->setButtonColor("dark");
    $navbar->setButtonClasses("me-3 text-white");
    $navbar->setButtonLinks([
        "Register" => "client-registration"
    ]);
    $navbar->setButtonContainerClasses("me-3");

    $navbar->setNavBarUlClasses("ms-auto mt-2 mt-lg-0");

    $navbar->runSetup();
}

/**
 * Student navbar set up
 * @param string $page
 * @return void
 */
function runClientNavbarSetUp(string $page)
{
    Session::start();
    $navbar = new Navbar;
    $navbar->setCurrentPage($page);
    navbarSetUpDefaults($navbar);
    if (Session::exists("cl_username")) {
        $profile = "Hi " . Client::run()->getFirstname(Session::get("cl_username"));
        $navbar->setNavItems([
            "Home",
            "Services",
            $profile
        ]);
        $navbar->setNavLinks([
            "Home" => "client-home",
            "Services" => "services",
            $profile => "#"
        ]);
        $navbar->setDropdownItems([
            $profile => [
                "My services",
                "My bookings",
                "My payments",
                "My discounts",
                "Log out"
            ]
        ]);
        $navbar->setDropdownItemClasses([
            $profile => "left-3"
        ]);
        $navbar->setDropdownItemsId([
            $profile => "profile"
        ]);
        $navbar->setDropDownItemLinks([
            $profile => [
                "My services" => "client-services",
                "My bookings" => "client-bookings",
                "My payments" => "client-payments",
                "My discounts" => "client-discounts",
                "Log out" => "#"
            ]
        ]);
        $navbar->setDropdownItemLinkClasses([
            "Log out" => "logout"
        ]);
        $logout = Url::getReference("resources/assets/images/png/shutdown.png");
        $payments = Url::getReference("resources/assets/images/png/dollar.png");
        $services = Url::getReference("resources/assets/images/png/plant.png");
        $bookings = Url::getReference("resources/assets/images/png/phone.png");
        $discounts = Url::getReference("resources/assets/images/png/payment-method.png");
        $navbar->setNavItemIcons([
            "Log out" => $logout,
            "My payments" => $payments,
            "My services" => $services,
            "Services" => $services,
            "My discounts" => $discounts,
            "My bookings" => $bookings
        ]);
        $iconClasses = "me-1 mb-1 md-small";
        $navbar->setNavItemIconClasses([
            "Log out" => $iconClasses,
            "My payments" => $iconClasses,
            "My services" => $iconClasses,
            "My bookings" => $iconClasses,
            "My discounts" => $iconClasses,
            "Services" => $iconClasses
        ]);
    }
    $navbar->setSeparator(false);

    $navbar->setNavBarUlClasses("ms-auto mt-2 mt-lg-0 mx-5");

    $navbar->runSetup();
}

/**
 * Attendant navbar setup
 * @param string $page
 * @return void
 */
function runAttendantNavbarSetUp(string $page)
{
    $navbar = new Navbar;
    $navbar->setCurrentPage($page);
    navbarSetUpDefaults($navbar);
    if (Session::exists("at_username")) {
        $profile = "Hi " . Attendant::run()->getFirstname(Session::get("at_username"));
        $navbar->setNavItems([
            "Home",
            "My servies",
            "My clients",
            "My bookings",
            $profile
        ]);
        $navbar->setNavLinks([
            "Home" => "tutor-home",
            "My clients" => "#",
            "My services" => "#",
            "My bookings" => "#",
            $profile => "#"
        ]);
        $navbar->setDropDownItems([
            "My services" => [
                "View services",
            ],
            "My bookings" => [
                "View bookings",
            ],
            "My clients" => [
                "View clients",
                "View payments"
            ],
            $profile => [
                "Log out"
            ]
        ]);
        $navbar->setDropDownItemsId([
            $profile => "log-out",
            "My clients" => "clients",
            "My bookings" => "bookings",
            "My services" => "services",
        ]);
        $navbar->setDropDownItemLinks([
            $profile => [
                "Log out" => "#",
            ],
            "My services" => [
                "View services" => "attendant-services",
            ],
            "My bookings" => [
                "View bookings" => "attendant-bookings",
            ],
            "My clients" => [
                "View clients" => "attendant-clients",
                "View payments" => "attendant-payments"
            ],
        ]);
        $navbar->setDropdownItemLinkClasses([
            "Log out" => "logout"
        ]);
        $logout = Url::getReference("resources/assets/images/png/shutdown.png");
        $open = Url::getReference("resources/assets/images/png/open-folder.png");
        $navbar->setNavItemIcons([
            "Log out" => $logout,
            "View services" => $open,
            "View clients" => $open,
            "View payments" => $open,
        ]);
        $iconClasses = "me-1 mb-1 md-small";
        $navbar->setNavItemIconClasses([
            "Log out" => $iconClasses,
            "View services" => $iconClasses,
            "View clients" => $iconClasses,
            "View payments" => $iconClasses,
        ]);
        $navbar->setDropdownItemClasses([
            "Home" => "left-3",
            "My services" => "left-3",
            "My clients" => "left-1",
            $profile => "left-3"
        ]);
        $navbar->setSeparator(false);
        $navbar->setNavBarUlClasses("ms-auto mt-2 mt-lg-0 mx-5");
        $navbar->runSetup();
    }

}

/**
 * Admin navbar setup
 * @param string $page
 * @return void
 */
function runAdminNavbarSetUp(string $page)
{
    $navbar = new Navbar;
    $navbar->setCurrentPage($page);
    navbarSetUpDefaults($navbar);
    if (Session::exists("ad_username")) {
        $profile = "Hi " . readAdmin()->getFirstname(Session::get("ad_username"));
        $navbar->setNavItems([
            "Home",
            "Attendants",
            "Clients",
            "Administrators",
            "Services",
            "Bookings",
            "Payments",
            $profile
        ]);
        $navbar->setNavLinks([
            "Home" => "admin-home",
            "Attendants" => "#",
            "Clients" => "#",
            "Administrators" => "#",
            "Bookings" => "#",
            "Services" => "#",
            "Payments" => "admin-payments",
            $profile => "#"
        ]);
        $navbar->setDropDownItemsId([
            $profile => "log-out",
            "Attendants" => "attendants",
            "Clients" => "clients",
            "Bookings" => "bookings",
            "Services" => "services",
            "Administrators" => "admin"
        ]);
        $navbar->setDropDownItems([
            "Attendants" => [
                "View attendants",
                "Add attendant"
            ],
            "Clients" => [
                "View clients",
            ],
            "Administrators" => [
                "View admins",
                "Add admin",
            ],
            "Bookings" => [
                "View bookings"
            ],
            "Services" => [
                "View services",
                "Add service",
            ],
            $profile => [
                "Log out"
            ]
        ]);

        $navbar->setDropDownItemLinks([
            $profile => [
                "Log out" => "#",
            ],
            "Attendants" => [
                "View attendants" => "admin-attendants",
                "Add attendant" => "admin-attendant-registration"
            ],
            "Clients" => [
                "View clients" => "admin-clients",
            ],
            "Administrators" => [
                "View admins" => "admin-administrators",
                "Add admin" => "admin-registration",
            ],
            "Bookings" => [
                "View bookings" => "admin-bookings"
            ],
            "Services" => [
                "View services" => "admin-services",
                "Add service" => "admin-service-registration"
            ],
        ]);
        $navbar->setDropdownItemLinkClasses([
            "Log out" => "logout"
        ]);
        $logout = Url::getReference("resources/assets/images/png/shutdown.png");
        $open = Url::getReference("resources/assets/images/png/open-folder.png");
        $add = Url::getReference("resources/assets/images/png/add.png");
        $navbar->setNavItemIcons([
            "Log out" => $logout,
            "View attendants" => $open,
            "Add attendant" => $add,
            "View clients" => $open,
            "View admins" => $open,
            "Add admin" => $add,
            "View bookings" => $open,
            "View services" => $open,
            "Add service" => $add
        ]);
        $iconClasses = "me-1 mb-1 md-small";
        $navbar->setNavItemIconClasses([
            "Log out" => $iconClasses,
            "View attendants" => $iconClasses,
            "Add attendant" => $iconClasses,
            "View clients" => $iconClasses,
            "View admins" => $iconClasses,
            "Add admin" => $iconClasses,
            "View bookings" => $iconClasses,
            "View services" => $iconClasses,
            "Add service" => $iconClasses
        ]);
        $navbar->setDropdownItemClasses([
            $profile => "left-3",
            "Attendants" => "left-3",
            "Clients" => "left-3",
            "Bookings" => "left-3",
            "Services" => "left-3",
            "Administrators" => "left-1"
        ]);
        $navbar->setNavBarUlClasses("ms-auto mt-2 mt-lg-0 mx-5");
        $navbar->setSeparator(false);
        $navbar->runSetup();
    }

}