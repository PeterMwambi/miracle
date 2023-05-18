<?php

namespace Models\Core\App\Database\Queries\Create;

use Models\Auth\Token;
use Models\Core\App\Database\Queries\Handler\Provider;
use Models\Core\App\Database\Queries\Read\Admin as ReadAdmin;
use Models\Core\App\Helpers\DateTime;
use Models\Core\App\Utilities\Session;

class Admin extends Provider
{

    /*
    ``````````````````````````````````````````````````````
    ADMIN REGISTRATION
    ``````````````````````````````````````````````````````
    */

    /**
     * Admin registration
     * @param array $data
     * @return bool
     */
    public function registerAdmin(array $data)
    {
        Session::start();
        parent::setData($data);
        parent::setUniqIdPrefix("DPAD");
        parent::setUniqId();
        $this->regsterAdminDataFromStep1();
        $this->registerAdminDataFromStep2();
        Session::set("ADMIN_ACCOUNT_ACCESS", Token::run()::generate("ADMIN_USER_AUTH"));
        return true;
    }


    /**
     * Admin registration step 1
     * @return void
     */
    private function regsterAdminDataFromStep1()
    {
        parent::generateFormData("admin-registration-form-step-1");
        parent::modifyFormDataKeys("-", "_", true, "ad_");
        $data = parent::getFormData();
        $data["ad_id"] = $this->getUniqId();
        $data["ad_phone_number"] = "+254" . $data["ad_phone_number"];
        $data["ad_date_of_birth"] = DateTime::run()->formatDate($data["ad_date_of_birth"], "d/m/Y");
        parent::setTable("admin_personal_info");
        parent::setQueryData($data);
        parent::insert();
    }

    /**
     * Admin registration step 2
     * @return void
     */
    private function registerAdminDataFromStep2()
    {
        parent::generateFormData("admin-registration-form-step-2");
        parent::modifyFormDataKeys("-", "_", true, "ad_");
        parent::pushSelectedKeys(["ad_username", "ad_password"]);
        $data = parent::getFormData();
        $data["ad_id"] = $this->getUniqId();
        $data["ad_password"] = password_hash($data["ad_password"], PASSWORD_DEFAULT);
        $data["ad_date_created"] = DateTime::run()->getDateTimeAsJson();
        $data["ad_last_login"] = DateTime::run()->getDateTimeAsJson();
        Session::set("ad_username", $data["ad_username"]);
        parent::setTable("admin_account_info");
        parent::setQueryData($data);
        parent::insert();
    }


    public function registerService(array $data)
    {
        Session::start();
        parent::setData($data);
        parent::setUniqIdPrefix("DPS");
        parent::setUniqId();
        $this->registerServiceDataFromStep1();
        $this->registerServiceDataFromStep2();
        return;
    }


    private function registerServiceDataFromStep1()
    {
        parent::generateFormData("service-registration-form-step-1");
        $attendantId = ReadAdmin::run()->getAttendantIdFromNameAndNumber(parent::getFormData()["attendant"]);
        $attendantId = $attendantId["at_id"];
        $serviceId = parent::getUniqId();
        $data = [
            "s_id" => $serviceId,
            "at_id" => $attendantId
        ];
        parent::setTable("services");
        parent::setQueryData($data);
        parent::insert();
    }

    private function registerServiceDataFromStep2()
    {
        parent::generateFormData("service-registration-form-step-1");
        parent::modifyFormDataKeys("-", "_", true, "sd_");
        parent::pushSelectedKeys(["sd_name", "sd_description", "sd_price"]);
        $data = parent::getFormData();
        $data["s_id"] = parent::getUniqId();
        $data["sd_date_created"] = DateTime::run()->getDateTimeAsJson();
        $data["sd_image"] = $this->getServiceDataFromStep3();
        parent::setTable("service_details");
        parent::setQueryData($data);
        parent::insert();
    }

    private function getServiceDataFromStep3()
    {
        parent::generateFormData("service-registration-form-step-2");
        $data = parent::getFormData();
        return $data["pictures"];
    }





}