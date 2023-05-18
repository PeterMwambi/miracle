<?php

namespace Models\Core\App\Database\Queries\Read;

use Models\Auth\Token;
use Models\Core\App\Database\Queries\Handler\Provider;
use Models\Core\App\Helpers\DateTime;
use Models\Core\App\Utilities\Session;

/**
 * Next versions should implement hashes for login
 */
class Attendant extends Provider
{

    private static $instance = null;


    public static function run()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Attendant;
        }
        return self::$instance;
    }


    public function loginTutor(array $data)
    {
        $this->setData($data);
        $this->prepareLoginPrimitives();
        return true;
    }

    private function prepareLoginPrimitives()
    {
        parent::generateFormData("attendant-login-form");
        $data = parent::getFormData();
        $username = $data["username"];
        Session::set("ATTENDANT_ACCOUNT_ACCESS", Token::run()::generate("ATTENDANT_USER_AUTH"));
        Session::set("at_username", $username);
        parent::setTable("attendant_account_info");
        parent::setQueryData(
            [
                "set" => array(
                    "at_last_login" => DateTime::run()->getDateTimeAsJson()
                ),
                "where" => array(
                    "at_username" => $username
                )
            ]
        );
        parent::update();
    }

    public function getFirstname(string $username)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("
            attendant_personal_info.at_firstname,
            attendant_personal_info.at_id");
        parent::setTable("attendant_personal_info");
        parent::setJoinClause("INNER JOIN 
            attendant_account_info 
            ON 
            attendant_personal_info.at_id = attendant_account_info.at_id
            WHERE attendant_account_info.at_username = ?");
        parent::setWhere([$username]);
        parent::setFetchControl("object");
        parent::setFetch(0);
        return parent::queryDataWithResults()->at_firstname;
    }

    public function getLoginTime($username)
    {
        parent::setAction("SELECT");
        parent::setFieldItems("attendant_account_info.at_last_login");
        parent::setTable("attendant_account_info");
        parent::setJoinClause("WHERE attendant_account_info.at_username = ?");
        parent::setWhere([$username]);
        parent::setFetchControl("object");
        parent::setFetch(0);
        $dateTime = json_decode(parent::queryDataWithResults()->at_last_login);
        return $dateTime->day . ", " . $dateTime->date . " " . $dateTime->time;
    }
}