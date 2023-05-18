<?php


namespace Models\Core\App\Database\Queries\Create;

use Models\Core\App\Database\Queries\Handler\Provider;
use Models\Core\App\Helpers\DateTime;


class Attendant extends Provider
{

    /*
    ```````````````````````````````````````````````````````````````````
    TUTOR REGISTRATION
    ```````````````````````````````````````````````````````````````````
    */

    /**
     * Regster tutor
     * @param array $data
     * @return bool
     */
    public function registerAttendant(array $data)
    {
        parent::setData($data);
        parent::setUniqIdPrefix("DPAT");
        parent::setUniqId();
        $this->regsterAttendantDataFromStep1();
        $this->registerAttendantDataFromStep2();
        return true;
    }


    /**
     * Register tutor data from step 1
     * @return void
     */
    protected function regsterAttendantDataFromStep1()
    {
        parent::generateFormData("attendant-registration-form-step-1");
        parent::modifyFormDataKeys("-", "_", true, "at_");
        $data = parent::getFormData();
        $data["at_id"] = $this->getUniqId();
        $data["at_phone_number"] = "+254" . $data["at_phone_number"];
        $data["at_date_of_birth"] = DateTime::run()->formatDate($data["at_date_of_birth"], "d/m/Y");
        parent::setTable("attendant_personal_info");
        parent::setQueryData($data);
        parent::insert();
    }

    /**
     * Register tutor data from  step 2
     * @return void
     */
    protected function registerAttendantDataFromStep2()
    {
        parent::generateFormData("attendant-registration-form-step-2");
        parent::modifyFormDataKeys("-", "_", true, "at_");
        parent::pushSelectedKeys(["at_username", "at_password"]);
        $data = parent::getFormData();
        $data["at_id"] = $this->getUniqId();
        $data["at_password"] = password_hash($data["at_password"], PASSWORD_DEFAULT);
        $data["at_ratings"] = 2;
        $data["at_reviews"] = json_encode(array());
        $data["at_date_created"] = DateTime::run()->getDateTimeAsJson();
        $data["at_last_login"] = DateTime::run()->getDateTimeAsJson();
        parent::setTable("attendant_account_info");
        parent::setQueryData($data);
        parent::insert();
    }

}