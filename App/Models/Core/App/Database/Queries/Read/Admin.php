<?php

namespace Models\Core\App\Database\Queries\Read;

use Models\Auth\Token;
use Models\Core\App\Database\Queries\Handler\Provider;
use Models\Core\App\Helpers\DateTime;
use Models\Core\App\Helpers\Formatter;
use Models\Core\App\Utilities\Session;

class Admin extends Provider
{
    private static $instance = null;

    public static function run()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Admin;
        }
        return self::$instance;
    }


    public function loginAdmin(array $data)
    {
        $this->setData($data);
        $this->prepareLoginPrimitives();
        return true;
    }

    private function prepareLoginPrimitives()
    {
        parent::generateFormData("admin-login-form");
        $data = parent::getFormData();
        $username = $data["username"];
        Session::start();
        Session::set("ADMIN_ACCOUNT_ACCESS", Token::run()::generate("ADMIN_USER_AUTH"));
        Session::set("ad_username", $username);
        parent::setTable("admin_account_info");
        parent::setQueryData(
            [
                "set" => array(
                    "ad_last_login" => DateTime::run()->getDateTimeAsJson()
                ),
                "where" => array(
                    "ad_username" => $username
                )
            ]
        );
        parent::update();
    }

    public function getFirstname(string $username)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
            admin_personal_info.ad_firstname,
            admin_personal_info.ad_id");
        parent::setTable("admin_personal_info");
        parent::setJoinClause("
            INNER JOIN 
            admin_account_info 
            ON 
            admin_personal_info.ad_id = admin_account_info.ad_id
            WHERE admin_account_info.ad_username = ?");
        parent::setWhere([$username]);
        parent::setFetchControl("object");
        parent::setFetch(0);
        return parent::queryDataWithResults()->ad_firstname;
    }

    public function getLoginTime(string $username)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("admin_account_info.ad_last_login");
        parent::setTable("admin_account_info");
        parent::setJoinClause("WHERE admin_account_info.ad_username = ?");
        parent::setWhere([$username]);
        parent::setFetchControl("object");
        parent::setFetch(0);
        $dateTime = json_decode(parent::queryDataWithResults()->ad_last_login);
        return $dateTime->day . ", " . $dateTime->date . " " . $dateTime->time;
    }

    public function getAttendants()
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
        attendant_personal_info.at_id,
        attendant_personal_info.at_firstname,
        attendant_personal_info.at_lastname,
        attendant_personal_info.at_gender,
        attendant_personal_info.at_date_of_birth,
        attendant_personal_info.at_age,
        attendant_personal_info.at_nationality,
        attendant_personal_info.at_national_id,
        attendant_personal_info.at_phone_number,
        attendant_personal_info.at_email,
        attendant_account_info.at_date_created,
        attendant_account_info.at_username,
        attendant_account_info.at_last_login");
        parent::setTable("attendant_personal_info");
        parent::setJoinClause("
        INNER JOIN attendant_account_info
        ON
        attendant_personal_info.at_id = attendant_account_info.at_id
        ");
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }

    public function getClients()
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
        client_personal_info.cl_id,
        client_personal_info.cl_firstname,
        client_personal_info.cl_lastname,
        client_personal_info.cl_gender,
        client_personal_info.cl_date_of_birth,
        client_personal_info.cl_age,
        client_personal_info.cl_nationality,
        client_personal_info.cl_national_id,
        client_personal_info.cl_phone_number,
        client_personal_info.cl_email,
        client_account_info.cl_date_created,
        client_account_info.cl_username,
        client_account_info.cl_last_login");
        parent::setTable("client_personal_info");
        parent::setJoinClause("
        INNER JOIN client_account_info
        ON
        client_personal_info.cl_id = client_account_info.cl_id
        ");
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }

    public function getAdministrators()
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
        admin_personal_info.ad_id,
        admin_personal_info.ad_firstname,
        admin_personal_info.ad_lastname,
        admin_personal_info.ad_gender,
        admin_personal_info.ad_date_of_birth,
        admin_personal_info.ad_age,
        admin_personal_info.ad_nationality,
        admin_personal_info.ad_national_id,
        admin_personal_info.ad_phone_number,
        admin_personal_info.ad_email,
        admin_account_info.ad_date_created,
        admin_account_info.ad_username,
        admin_account_info.ad_last_login
        ");
        parent::setTable("admin_personal_info");
        parent::setJoinClause("
        INNER JOIN admin_account_info
        ON
        admin_personal_info.ad_id = admin_account_info.ad_id");
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }



    public function getAttendantIdFromNameAndNumber(string $data, bool $getId = true)
    {
        $data = explode(" ", str_replace(",", "", $data));
        if (is_array($data)) {
            $data = Formatter::run()->formatArray($data, ["firstname", "lastname", "phone-number"]);
            if (count($data) === 3) {
                $data["phone-number"] = str_replace("0", "+254", $data["phone-number"]);
                parent::setAction("SELECT");
                parent::setFieldItems("at_id");
                parent::setTable("attendant_personal_info");
                parent::setJoinClause("WHERE at_firstname = ? AND at_lastname = ? AND at_phone_number = ?");
                parent::setWhere([$data["firstname"], $data["lastname"], $data["phone-number"]]);
                if (is_array(parent::queryDataWithResults())) {
                    switch ($getId) {
                        case "true":
                            return parent::queryDataWithResults();
                        case "false":
                            return true;
                    }
                } else {
                    return false;
                }
            }
            return false;
        }
        return false;
    }

    public function getServices()
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
            attendant_personal_info.at_firstname,
            attendant_personal_info.at_lastname,
            services.s_id,
            attendant_personal_info.at_id,
            service_details.sd_name,
            service_details.sd_price,
            service_details.sd_description,
            service_details.sd_date_created,
            service_details.sd_image
        ");
        parent::setTable("services");
        parent::setJoinClause("
        INNER JOIN service_details
        ON
        service_details.s_id = services.s_id
        INNER JOIN attendant_personal_info
        ON
        services.at_id = attendant_personal_info.at_id
        
        ");
        parent::setFetchControl("array");
        parent::setFetch(1);
        return parent::queryDataWithResults();
    }


    public function getAttendantName(string $atId)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
        attendant_personal_info.at_firstname,
        attendant_personal_info.at_lastname");
        parent::setTable("attendant_personal_info");
        parent::setJoinClause("WHERE attendant_personal_info.at_id = ?");
        parent::setWhere([$atId]);
        parent::setFetchControl("array");
        parent::setFetch(0);
        $result = parent::queryDataWithResults();
        if (is_array($result)) {
            return $result["at_firstname"] . " " . $result["at_lastname"];
        } else {
            return false;
        }
    }

    public function getPayments()
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
        client_personal_info.cl_firstname,
        client_personal_info.cl_lastname,
        attendant_personal_info.at_firstname,
        attendant_personal_info.at_lastname,
        attendant_personal_info.at_id, 
        payments.pm_id,
        payments.cl_id,
        payments.at_id,
        payments.bk_id,
        service_details.sd_name,
        payment_details.pmd_amount,
        payment_details.pmd_balance,
        payment_details.pmd_mode,
        payment_details.pmd_transaction_code,
        payment_details.pmd_status,
        payment_details.pmd_discount,
        payment_details.pmd_date_added");
        parent::setTable("payments");
        parent::setJoinClause("
            INNER JOIN attendant_personal_info ON
            payments.at_id = attendant_personal_info.at_id
            INNER JOIN bookings ON
            payments.bk_id = bookings.bk_id
            INNER JOIN service_details ON
            bookings.s_id = service_details.s_id
            INNER JOIN payment_details ON
            payments.pm_id = payment_details.pm_id
            INNER JOIN client_personal_info ON
            payments.cl_id = client_personal_info.cl_id
        ");
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }


    public function getBookings()
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
            bookings.bk_id,
            client_personal_info.cl_firstname,
            client_personal_info.cl_lastname,
            booking_details.bkd_expected_checkin_date,
            booking_details.bkd_checkin_date,
            booking_details.bkd_status,
            booking_details.bkd_date_created
        ");
        parent::setTable("bookings");
        parent::setJoinClause("
            INNER JOIN booking_details ON
            bookings.bk_id = booking_details.bk_id
            INNER JOIN client_personal_info ON
            bookings.cl_id = client_personal_info.cl_id
        ");
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }

}