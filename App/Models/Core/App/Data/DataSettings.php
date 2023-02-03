<?php


namespace Models\Core\App\Data;

use Exception;
use Models\Core\App\Helpers\Formatter;

class DataSettings extends Data
{

    private $_settings = array();

    private static $_instance;



    private function _GetSettings()
    {
        if (!empty($this->_settings)) {
            return $this->_settings;
        } else {
            throw new Exception("Warning: Data settings have not been initialized");
        }
    }

    private function _SetFormSetting()
    {
        parent::WriteFormSettings();
        $this->_settings = Formatter::FormatToArray($this->GetFormSettings())[$this->GetForm()];
    }



    /**
     * Summary of _GetSetting
     * @return mixed
     */
    protected function _GetSetting()
    {
        $this->_SetFormSetting();
        return $this->_GetSettings();
    }


    private static function _GetInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DataSettings;
        }
        return self::$_instance;
    }


    public static function SetForm(string $form)
    {
        self::_GetInstance()->WriteForm($form);
    }


    public function GenerateData()
    {
        return $this->GenerateFormData($this->GetForm());
    }



    public static function GetAction()
    {
        return self::_GetInstance()->_GetSetting()->action;
    }



    public static function GetRulePath()
    {
        return self::_GetInstance()->_GetSetting()->rules;
    }

    public static function GetErrorPath()
    {
        return self::_GetInstance()->_GetSetting()->errors;

    }

    public static function GetMethodHandler()
    {
        return self::_GetInstance()->_GetSetting()->method;

    }
    public static function GetData()
    {
        return self::_GetInstance()->GenerateData();
    }

    public static function GetSuccessMessage()
    {
        return self::_GetInstance()->_GetSetting()->successmessage;
    }

    public static function GetErrorMessage()
    {
        return self::_GetInstance()->_GetSetting()->errormessage;
    }

    public static function GetNextStep()
    {
        return self::_GetInstance()->_GetSetting()->nextstep;
    }


    public static function GetFinalMethod()
    {
        if (array_key_exists("finalmethod", Formatter::FormatToArray(self::_GetInstance()->_GetSettings()))) {
            return self::_GetInstance()->_GetSetting()->finalmethod;
        }
    }



}