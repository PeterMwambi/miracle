<?php

use Models\Auth\Input;
use Models\Auth\Sanitize;
use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Database\Queries\Read\Client;
use Models\Core\App\Helpers\Formatter;
use Models\Core\App\Utilities\Session;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Classes\Table;




/*
```````````````````````````````````````````````````````````````````````
DEFAULT PROPERTIES
```````````````````````````````````````````````````````````````````````
*/

/**
 * Table default properties
 * @param Table $table
 * @return void
 */
function setTableDefaultProperties(Table $table)
{
    $table->setType("default");
    $table->setTableColor("light");
    $table->setTableType("bordered");
}


/* 
```````````````````````````````````````````````````````````````````````
CLIENT TABLES
```````````````````````````````````````````````````````````````````````
*/

/**
 * Admin view administrators setup
 * @return void
 */
function runClientViewBookingsSetup()
{
    $table = new Table;
    $bookingControl = (Input::get("bstatus")) ? Sanitize::string(Input::get("bstatus")) : "active";
    $bookings = Client::run()->getBookings(Session::get("cl_username"), $bookingControl);
    if (!is_array($bookings)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Booking id",
        "Service name",
        "Attendant",
        "Price",
        "Booking status",
        "Booked on",
    ];
    if ($bookingControl === "active") {
        array_push($keys, "Expected checkin date", "Actions");
    }
    if ($bookingControl === "complete") {
        array_push($keys, "Attended on");
    }
    $x = 1;
    foreach ($bookings as $booking) {
        $date = json_decode($booking["bkd_date_created"]);
        $booking["bkd_date_created"] = $date->day . ", " . $date->date . " " . $date->time;
        $booking["at_firstname"] = $booking["at_firstname"] . " " . $booking["at_lastname"];
        $booking["link"] = '<a class="" href="?sid=' . $booking["bk_id"] . '">' . $booking["bk_id"] . '</a>';
        if ($bookingControl === "complete") {
            $booking["bkd_status"] = '<a class="btn btn-sm btn-outline-success" href="?bkid=' . $booking["bk_id"] . '">' . $booking["bkd_status"] . '</a>';
        }
        $generatedData = [
            $x,
            $booking["link"],
            $booking["sd_name"],
            $booking["at_firstname"],
            number_format($booking["sd_price"]),
            $booking["bkd_status"],
            $booking["bkd_date_created"],
        ];
        if ($bookingControl === "active") {
            $booking["actions"] = '<a class="btn btn-dark" href="client-payment?bkid=' . $booking["bk_id"] . '&atid=' . $booking["at_id"] . '&price=' . $booking["sd_price"] . '&sid=' . $booking["s_id"] . '">Pay order</a>';
            array_push(
                $generatedData,
                $booking["bkd_expected_checkin_date"],
                $booking["actions"]
            );
        }
        if ($bookingControl === "complete") {
            array_push($generatedData, $booking["bkd_checkin_date"]);
        }
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}

/**
 * Client view paymet setup
 * @return void
 */
function runClientViewPaymentsSetup()
{
    $table = new Table;
    $payments = Client::run()->getPayments(Session::get("cl_username"));
    if (!is_array($payments)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Payment id",
        "Payment amount",
        "Paid to",
        "Payment mode",
        "Transaction code",
        "Balance",
        "Discount Awarded",
        "Payment status",
        "Paid on"
    ];
    $x = 1;
    foreach ($payments as $payment) {
        $date = json_decode($payment["pmd_date_added"]);
        $payment["pmd_date_added"] = $date->day . ", " . $date->date . " " . $date->time;
        $payment["at_firstname"] = $payment["at_firstname"] . " " . $payment["at_lastname"];
        $payment["link"] = '<a class="" href="?pmid=' . $payment["pm_id"] . '">' . $payment["pm_id"] . '</a>';
        $generatedData = [
            $x,
            $payment["link"],
            number_format($payment["pmd_amount"]),
            $payment["at_firstname"],
            $payment["pmd_mode"],
            $payment["pmd_transaction_code"],
            $payment["pmd_balance"],
            $payment["pmd_discount"],
            $payment["pmd_status"],
            $payment["pmd_date_added"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}

/**
 * Client view discount setup
 * @return void
 */
function runClientViewDiscountsSetup()
{
    $table = new Table;
    $discountControl = (Input::get("dstatus")) ? Sanitize::string(Input::get("dstatus")) : "active";
    $discounts = Client::run()->getDiscounts(Session::get("cl_username"), $discountControl);
    if (!is_array($discounts)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Discount id",
        "Discount amount",
        "Discount status",
        "Date generated",
        "Action"
    ];
    $x = 1;
    foreach ($discounts as $discount) {
        $date = json_decode($discount["d_date_created"]);
        $discount["d_date_created"] = $date->day . ", " . $date->date . " " . $date->time;
        $discount["link"] = '<a class="" href="?did=' . $discount["d_id"] . '">' . $discount["d_id"] . '</a>';
        $discount["redeem"] = '<a class="btn btn-dark" href="?did=' . $discount["d_id"] . '&action=redeem">Redeem</a>';
        $generatedData = [
            $x,
            $discount["link"],
            number_format($discount["d_amount"]),
            $discount["d_status"],
            $discount["d_date_created"],
            $discount["redeem"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}

/**
 * Client view services setup
 * @return void
 */
function runClientViewServicesSetup()
{
    $services = Client::run()->getServices(Session::get("cl_username"));
    if (!is_array($services)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $table = new Table;
    $data = [];
    $totalprice = [];
    $keys = [
        "#",
        "Service id",
        "Name",
        "Attendant",
        "Price",
        "Amount paid",
        "Balance",
        "Payment mode",
        "Transaction code",
        "Provided on",
        "Actions"
    ];
    $x = 0;
    foreach ($services as $service) {
        array_push($totalprice, $service["sd_price"]);
        $service["at_firstname"] = $service["at_firstname"] . " " . $service["at_lastname"];
        $link = '<a href="' . $service["s_id"] . '">' . $service["s_id"] . '</a>';
        $actions = '<a class="btn btn-primary" href="' . $service["s_id"] . '">
        <img src="' . Url::getReference("resources/assets/images/png/open-folder.png") . '" class="img-fluid small mb-1">
        View details
        </a>';
        $generatedData = [
            $x,
            $link,
            $service["sd_name"],
            $service["at_firstname"],
            number_format($service["sd_price"]),
            $service["pmd_amount"],
            $service["pmd_balance"],
            $service["pmd_mode"],
            $service["pmd_transaction_code"],
            $service["bkd_checkin_date"],
            $actions
        ];
        array_push($data, Formatter::run()->formatArray($generatedData, $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}

/*
```````````````````````````````````````````````````````````````````````
ATTENDANT TABLES
```````````````````````````````````````````````````````````````````````
*/





/*
```````````````````````````````````````````````````````````````````````
ADMIN TABLES
```````````````````````````````````````````````````````````````````````
*/


/**
 * Admin view student setup
 * @return void
 */
function runAdminViewClientsSetup()
{
    $table = new Table;
    $clients = Admin::run()->getClients();
    if (!is_array($clients)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Client Id",
        "Name",
        "Gender",
        "Date of Birth",
        "Age",
        "Nationality",
        "National id",
        "Phone number",
        "Email",
        "Username",
        "Date created"
    ];
    $x = 1;
    foreach ($clients as $client) {
        $date = json_decode($client["cl_date_created"]);
        $client["cl_date_created"] = $date->day . ", " . $date->date . " " . $date->time;
        $client["cl_firstname"] = $client["cl_firstname"] . " " . $client["cl_lastname"];
        $client["cl_phone_number"] = str_replace("+254", "0", $client["cl_phone_number"]);
        $client["cl_id"] = '<a class="" href="?ctid=' . $client["cl_id"] . '">' . $client["cl_id"] . '</a>';
        $generatedData = [
            $x,
            $client["cl_id"],
            $client["cl_firstname"],
            $client["cl_gender"],
            $client["cl_date_of_birth"],
            $client["cl_age"],
            $client["cl_nationality"],
            $client["cl_national_id"],
            $client["cl_phone_number"],
            $client["cl_email"],
            $client["cl_username"],
            $client["cl_date_created"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}

/**
 * Admin view attendants setup
 * @return void
 */
function runAdminViewAttendantsSetup()
{
    $table = new Table;
    $attendants = Admin::run()->getAttendants();
    if (!is_array($attendants)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Tutor Id",
        "Name",
        "Gender",
        "Date of Birth",
        "Age",
        "Nationality",
        "National id",
        "Phone number",
        "Email",
        "Username",
        "Date created"
    ];
    $x = 1;
    foreach ($attendants as $attendant) {
        $date = json_decode($attendant["at_date_created"]);
        $attendant["at_date_created"] = $date->day . ", " . $date->date . " " . $date->time;
        $attendant["at_firstname"] = $attendant["at_firstname"] . " " . $attendant["at_lastname"];
        $attendant["at_phone_number"] = str_replace("+254", "0", $attendant["at_phone_number"]);
        $attendant["at_id"] = '<a class="" href="?atid=' . $attendant["at_id"] . '">' . $attendant["at_id"] . '</a>';
        $generatedData = [
            $x,
            $attendant["at_id"],
            $attendant["at_firstname"],
            $attendant["at_gender"],
            $attendant["at_date_of_birth"],
            $attendant["at_age"],
            $attendant["at_nationality"],
            $attendant["at_national_id"],
            $attendant["at_phone_number"],
            $attendant["at_email"],
            $attendant["at_username"],
            $attendant["at_date_created"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}


/**
 * Admin view administrators setup
 * @return void
 */
function runAdminViewAdministratorsSetup()
{
    $table = new Table;
    $administrators = Admin::run()->getAdministrators();
    if (!is_array($administrators)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Admin id",
        "Name",
        "Gender",
        "Date of Birth",
        "Age",
        "Nationality",
        "National id",
        "Phone number",
        "Email",
        "Username",
        "Date created"
    ];
    $x = 1;
    foreach ($administrators as $admin) {
        $date = json_decode($admin["ad_date_created"]);
        $admin["ad_date_created"] = $date->day . ", " . $date->date . " " . $date->time;
        $admin["ad_firstname"] = $admin["ad_firstname"] . " " . $admin["ad_lastname"];
        $admin["ad_phone_number"] = str_replace("+254", "0", $admin["ad_phone_number"]);
        $admin["ad_id"] = '<a class="" href="?adid=' . $admin["ad_id"] . '">' . $admin["ad_id"] . '</a>';
        $generatedData = [
            $x,
            $admin["ad_id"],
            $admin["ad_firstname"],
            $admin["ad_gender"],
            $admin["ad_date_of_birth"],
            $admin["ad_age"],
            $admin["ad_nationality"],
            $admin["ad_national_id"],
            $admin["ad_phone_number"],
            $admin["ad_email"],
            $admin["ad_username"],
            $admin["ad_date_created"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}

/**
 * Admin view administrators setup
 * @return void
 */
function runAdminViewServicesSetup()
{
    $table = new Table;
    $services = Admin::run()->getServices();
    if (!is_array($services)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Service id",
        "Service image",
        "Service name",
        "Attendant",
        "Date created",
    ];
    $x = 1;
    foreach ($services as $service) {
        $date = json_decode($service["sd_date_created"]);
        $service["sd_date_created"] = $date->day . ", " . $date->date . " " . $date->time;
        $service["at_firstname"] = $service["at_firstname"] . " " . $service["at_lastname"];
        $service["s_id"] = '<a class="" href="?sid=' . $service["s_id"] . '">' . $service["s_id"] . '</a>';
        $service["sd_image"] = '<img src="' . Url::getReference("uploads/services/" . $service["sd_image"]) . '" class="img-fluid medium">';
        $generatedData = [
            $x,
            $service["s_id"],
            $service["sd_image"],
            $service["sd_name"],
            $service["at_firstname"],
            $service["sd_date_created"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}

/**
 * Admin view payments setup
 * @return void
 */
function runAdminViewPaymentsSetup()
{
    $table = new Table;
    $payments = Admin::run()->getPayments();
    if (!is_array($payments)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Payment id",
        "Payment amount",
        "Narrator",
        "Paid to",
        "Payment mode",
        "Transaction code",
        "Balance",
        "Discount",
        "Payment status",
        "Date added"
    ];
    $x = 1;
    foreach ($payments as $payment) {
        $date = json_decode($payment["pmd_date_added"]);
        $payment["pmd_date_added"] = $date->day . ", " . $date->date . " " . $date->time;
        $payment["cl_firstname"] = $payment["cl_firstname"] . " " . $payment["cl_lastname"];
        $payment["at_firstname"] = $payment["at_firstname"] . " " . $payment["at_lastname"];
        $payment["pm_id"] = '<a class="" href="?pmid=' . $payment["pm_id"] . '">' . $payment["pm_id"] . '</a>';
        $generatedData = [
            $x,
            $payment["pm_id"],
            $payment["pmd_amount"],
            $payment["cl_firstname"],
            $payment["at_firstname"],
            $payment["pmd_mode"],
            $payment["pmd_transaction_code"],
            $payment["pmd_balance"],
            $payment["pmd_discount"],
            $payment["pmd_status"],
            $payment["pmd_date_added"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}



/**
 * Admin view payments setup
 * @return void
 */
function runAdminViewBookingsSetup()
{
    $table = new Table;
    $bookings = Admin::run()->getBookings();
    if (!is_array($bookings)) {
        echo '<div class="d-flex justify-content-center mt-md"><h4>Oops! no records were found</h4></div>';
        return;
    }
    $data = [];
    $keys = [
        "#",
        "Booking id",
        "Client",
        "Expected checkin date",
        "Check in date",
        "Booking status",
        "Date created"
    ];
    $x = 1;
    foreach ($bookings as $booking) {
        $date = json_decode($booking["bkd_date_created"]);
        $booking["bkd_date_created"] = $date->day . ", " . $date->date . " " . $date->time;
        $booking["cl_firstname"] = $booking["cl_firstname"] . " " . $booking["cl_lastname"];
        $booking["bk_id"] = '<a class="" href="?pmid=' . $booking["bk_id"] . '">' . $booking["bk_id"] . '</a>';
        $generatedData = [
            $x,
            $booking["bk_id"],
            $booking["cl_firstname"],
            $booking["bkd_expected_checkin_date"],
            $booking["bkd_checkin_date"],
            $booking["bkd_status"],
            $booking["bkd_date_created"]
        ];
        array_push($data, Formatter::run()->formatArray(array_values($generatedData), $keys));
        $x++;
    }
    setTableDefaultProperties($table);
    $table->setColumns($keys);
    $table->setData($data);
    $table->runSetup();
}