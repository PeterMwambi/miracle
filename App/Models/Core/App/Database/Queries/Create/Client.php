<?php


namespace Models\Core\App\Database\Queries\Create;

use Models\Auth\Token as AuthToken;
use Models\Core\App\Database\Queries\Handler\Provider;
use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Database\Queries\Read\Client as ReadClient;
use Models\Core\App\Helpers\DateTime;
use Models\Core\App\Helpers\Formatter;
use Models\Core\App\Utilities\Session;

class Client extends Provider
{


    public function registerClient(array $data)
    {
        Session::start();
        parent::setData($data);
        parent::setUniqIdPrefix("DPCL");
        parent::setUniqId();
        $this->regsterClientDataFromStep1();
        $this->registerClientDataFromStep2();
        Session::set("CLIENT_ACCOUNT_ACCESS", AuthToken::run()::generate("CLIENT_USER_AUTH"));
        return true;
    }


    private function regsterClientDataFromStep1()
    {
        parent::generateFormData("client-registration-form-step-1");
        parent::modifyFormDataKeys("-", "_", true, "cl_");
        $data = parent::getFormData();
        $data["cl_id"] = $this->getUniqId();
        $data["cl_phone_number"] = "+254" . $data["cl_phone_number"];
        $data["cl_date_of_birth"] = DateTime::run()->formatDate($data["cl_date_of_birth"], "d/m/Y");
        parent::setTable("client_personal_info");
        parent::setQueryData($data);
        parent::insert();
    }

    private function registerClientDataFromStep2()
    {
        parent::generateFormData("client-registration-form-step-2");
        parent::modifyFormDataKeys("-", "_", true, "cl_");
        parent::pushSelectedKeys(["cl_username", "cl_password"]);
        $data = parent::getFormData();
        $data["cl_id"] = $this->getUniqId();
        $data["cl_password"] = password_hash($data["cl_password"], PASSWORD_DEFAULT);
        $data["cl_date_created"] = DateTime::run()->getDateTimeAsJson();
        $data["cl_last_login"] = DateTime::run()->getDateTimeAsJson();
        Session::set("cl_username", $data["cl_username"]);
        parent::setTable("client_account_info");
        parent::setQueryData($data);
        parent::insert();
    }


    public function processBooking(array $data)
    {
        Session::start();
        parent::setData($data);
        parent::setUniqIdPrefix("DPBK");
        parent::setUniqId();
        $this->registerBookingDataFromStep1();
        $this->registerBookingDataFromStep2();
        return;
    }

    private function registerBookingDataFromStep1()
    {
        $serviceId = Session::get("sid");
        $clientId = ReadClient::run()->getclientId(Session::get("cl_username"));
        $bookingId = parent::getUniqId();
        $data = [
            "bk_id" => $bookingId,
            "s_id" => $serviceId,
            "cl_id" => $clientId
        ];
        parent::setTable("bookings");
        parent::setQueryData($data);
        parent::insert();
    }

    private function registerBookingDataFromStep2()
    {
        parent::generateFormData("client-booking-form");
        $formdata = parent::getFormData();
        $date = DateTime::run()->formatDate($formdata["expected-checkin-date"], "l, d/m/Y");
        $time = DateTime::run()->formatDate($formdata["expected-checkin-time"], "g:iA");
        $data = [];
        $data["bk_id"] = parent::getUniqId();
        $data["bkd_expected_checkin_date"] = $date . " " . $time;
        $data["bkd_status"] = "active";
        $data["bkd_checkin_date"] = "pending";
        $data["bkd_date_created"] = DateTime::run()->getDateTimeAsJson();
        parent::setTable("booking_details");
        parent::setQueryData($data);
        parent::insert();
    }


    public function processPayment(array $data)
    {
        Session::start();
        parent::setData($data);
        parent::setUniqIdPrefix("DPPM");
        parent::setUniqId();
        $this->registerPaymentDataFromStep1();
        $this->registerPaymentDataFromStep2();
        parent::setTable("booking_details");
        parent::setQueryData(
            [
                "set" => array(
                    "bkd_status" => "complete",
                    "bkd_checkin_date" => date("l, d/m/Y g:iA")
                ),
                "where" => array(
                    "bk_id" => Session::get("bkid")
                )
            ]
        );
        parent::update();
        return;
    }


    private function registerPaymentDataFromStep1()
    {
        $clientId = ReadClient::run()->getclientId(Session::get("cl_username"));
        $bookingId = Session::get("bkid");
        $attendantId = Session::get("atid");
        $data = [
            "pm_id" => parent::getUniqId(),
            "cl_id" => $clientId,
            "at_id" => $attendantId,
            "bk_id" => $bookingId
        ];
        parent::setTable("payments");
        parent::setQueryData($data);
        parent::insert();
    }

    private function registerPaymentDataFromStep2()
    {
        parent::generateFormData("client-payment-form");
        parent::modifyFormDataKeys("-", "_", true, "pmd_");
        $data = parent::getFormData();
        $data["pm_id"] = parent::getUniqId();
        if (Session::exists("did")) {
            $data["pmd_discount"] = ReadClient::run()->getDiscountFromId(Session::get("did"));
            $data["pmd_balance"] = (Session::get("price") - ReadClient::run()->getDiscountFromId(Session::get("did"))) - $data["pmd_amount"];
            parent::setTable("discounts");
            parent::setQueryData(
                [
                    "set" => array(
                        "d_status" => "redeemed",
                        "d_date_redeemed" => date("l, d/m/Y g:iA")
                    ),
                    "where" => array(
                        "d_id" => Session::get("did")
                    )
                ]
            );
            parent::update();
            Session::destroy("did");
        } else {
            $data["pmd_discount"] = number_format(($data["pmd_amount"]) / 60);
            $data["pmd_balance"] = Session::get("price") - $data["pmd_amount"];
            $this->registerDiscount($data["pmd_discount"]);
        }
        $data["pmd_status"] = ($data["pmd_balance"] > 0) ? "pending" : "verified";
        $data["pmd_date_added"] = DateTime::run()->getDateTimeAsJson();
        parent::setTable("payment_details");
        parent::setQueryData($data);
        parent::insert();
        return;
    }
    private function registerDiscount($amount)
    {
        parent::setUniqIdPrefix("DPD");
        parent::setUniqId();
        $clientId = ReadClient::run()->getclientId(Session::get("cl_username"));
        $data = [
            "d_id" => parent::getUniqId(),
            "cl_id" => $clientId,
            "d_amount" => $amount,
            "d_status" => "active",
            "d_date_created" => DateTime::run()->getDateTimeAsJson()
        ];
        parent::setTable("discounts");
        parent::setQueryData($data);
        parent::insert();
        return;
    }




}