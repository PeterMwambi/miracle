<?php

namespace Models\Core\App\Database\Queries\Read;

use Models\Auth\Token;
use Models\Core\App\Database\Queries\Handler\Provider;
use Models\Core\App\Helpers\DateTime;
use Models\Core\App\Utilities\Session;

/**
 * Next versions should implement hashes for login
 */
class Client extends Provider
{

    private static $instance = null;


    public static function run()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Client;
        }
        return self::$instance;
    }


    public function loginClient(array $data)
    {
        $this->setData($data);
        $this->prepareLoginPrimitives();
        return true;
    }

    private function prepareLoginPrimitives()
    {
        parent::generateFormData("client-login-form");
        $data = parent::getFormData();
        $username = $data["username"];
        Session::start();
        Session::set("CLIENT_ACCOUNT_ACCESS", Token::run()::generate("CLIENT_USER_AUTH"));
        Session::set("cl_username", $username);
        parent::setTable("client_account_info");
        parent::setQueryData(
            [
                "set" => array(
                    "cl_last_login" => DateTime::run()->getDateTimeAsJson()
                ),
                "where" => array(
                    "cl_username" => $username
                )
            ]
        );
        parent::update();
    }


    public function getLoginTime(string $username)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("client_account_info.cl_last_login");
        parent::setTable("client_account_info");
        parent::setJoinClause("WHERE client_account_info.cl_username = ?");
        parent::setWhere([$username]);
        parent::setFetchControl("object");
        parent::setFetch(0);
        $dateTime = json_decode(parent::queryDataWithResults()->cl_last_login);
        return $dateTime->day . ", " . $dateTime->date . " " . $dateTime->time;
    }
    public function getFirstname(string $username)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
            client_personal_info.cl_firstname,
            client_personal_info.cl_id");
        parent::setTable("client_personal_info");
        parent::setJoinClause("INNER JOIN 
            client_account_info 
            ON 
            client_personal_info.cl_id = client_account_info.cl_id
            WHERE client_account_info.cl_username = ?");
        parent::setWhere([$username]);
        parent::setFetchControl("object");
        parent::setFetch(0);
        return parent::queryDataWithResults()->cl_firstname;
    }

    public function getclientId(string $username)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("client_account_info.cl_id");
        parent::setTable("client_account_info");
        parent::setJoinClause("WHERE client_account_info.cl_username = ?");
        parent::setWhere([$username]);
        parent::setFetchControl("array");
        parent::setFetch(0);
        return parent::queryDataWithResults()["cl_id"];
    }

    public function getService(string $serviceId)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
            attendant_personal_info.at_firstname,
            attendant_personal_info.at_lastname,
            attendant_personal_info.at_phone_number,
            services.s_id,
            attendant_personal_info.at_id,
            service_details.sd_name,
            service_details.sd_price,
            service_details.sd_description,
            service_details.sd_image,
            service_details.sd_date_created
        ");
        parent::setTable("services");
        parent::setJoinClause("
        INNER JOIN service_details ON
        services.s_id = service_details.s_id
        INNER JOIN attendant_personal_info ON
        services.at_id = attendant_personal_info.at_id
        WHERE services.s_id = ?");
        parent::setWhere([$serviceId]);
        parent::setFetch(0);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }

    public function getBookings(string $username, string $status = "pending")
    {
        $clientId = $this->getclientId($username);
        parent::setAction("SELECT");
        parent::setFieldItems("
        attendant_personal_info.at_firstname,
        attendant_personal_info.at_lastname,
        attendant_personal_info.at_phone_number,
        attendant_personal_info.at_id,
        service_details.s_id,
        bookings.bk_id,
        service_details.sd_name,
        service_details.sd_price,
        booking_details.bkd_expected_checkin_date,
        booking_details.bkd_checkin_date,
        booking_details.bkd_status,
        booking_details.bkd_date_created");
        parent::setTable("bookings");
        parent::setJoinClause("
        INNER JOIN booking_details ON
        bookings.bk_id = booking_details.bk_id
        INNER JOIN services ON 
        bookings.s_id = services.s_id
        INNER JOIN service_details ON
        bookings.s_id = service_details.s_id
        INNER JOIN attendant_personal_info ON
        services.at_id = attendant_personal_info.at_id
        WHERE bookings.cl_id = ? and booking_details.bkd_status = ?");
        parent::setWhere([$clientId, $status]);
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }

    public function getPayments(string $username)
    {
        $clientId = $this->getclientId($username);
        parent::setAction("SELECT");
        parent::setFieldItems("
        attendant_personal_info.at_firstname,
        attendant_personal_info.at_lastname,
        attendant_personal_info.at_phone_number,
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
            WHERE payments.cl_id = ?
        ");
        parent::setWhere([$clientId]);
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }

    public function getDiscounts(string $username, string $status = "active")
    {
        $clientId = $this->getclientId($username);
        parent::setAction("SELECT");
        parent::setFieldItems("
            discounts.d_id,
            discounts.cl_id,
            discounts.d_amount,
            discounts.d_status,
            discounts.d_date_created");
        parent::setTable("discounts");
        parent::setJoinClause("WHERE discounts.cl_id = ? AND d_status = ?");
        parent::setWhere([$clientId, $status]);
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }

    public function getDiscountFromId(string $did)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
            discounts.d_id,
            discounts.cl_id,
            discounts.d_amount,
            discounts.d_status,
            discounts.d_date_created");
        parent::setTable("discounts");
        parent::setJoinClause("WHERE discounts.d_id = ?");
        parent::setWhere([$did]);
        parent::setFetch(0);
        parent::setFetchControl("array");
        return parent::queryDataWithResults()["d_amount"];
    }


    public function getServices(string $username)
    {
        $clientId = $this->getclientId($username);
        parent::setAction("SELECT");
        parent::setFieldItems("
            services.s_id,
            service_details.sd_name,
            service_details.sd_description,
            service_details.sd_price,
            service_details.sd_image,
            attendant_personal_info.at_firstname,
            attendant_personal_info.at_lastname,
            booking_details.bkd_checkin_date,
            payments.pm_id,
            payment_details.pmd_amount,
            payment_details.pmd_mode,
            payment_details.pmd_balance,
            payment_details.pmd_transaction_code");
        parent::setTable("payments");
        parent::setJoinClause("
        INNER JOIN payment_details ON
        payments.pm_id = payment_details.pm_id
        INNER JOIN services ON 
        payments.at_id = services.at_id
        INNER JOIN service_details ON
        services.s_id = service_details.s_id
        INNER JOIN booking_details ON
        payments.bk_id = booking_details.bk_id
        INNER JOIN attendant_personal_info ON
        payments.at_id = attendant_personal_info.at_id
        WHERE payments.cl_id = ?");
        parent::setWhere([$clientId]);
        parent::setFetch(1);
        parent::setFetchControl("array");
        return parent::queryDataWithResults();
    }
}