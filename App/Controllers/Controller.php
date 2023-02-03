<?php

namespace Controllers;

use Exception;
use Models\Core\App\Dependancies\Settings as MainSettings;

class Controller extends MainSettings
{

    private $_data;

    private $_form;

    private $_settings;

    private $_keywords;

    private $_errors;

    private $_rules;

    private $_key;


    private $_formKeys;


    private $_value;



    protected function WriteForm($form)
    {
        $this->_form = $form;
    }
    protected function WriteRules(string $filename)
    {
        $this->_rules = parent::GetValidationRulesFromJSON($filename);
    }

    protected function WriteFormData()
    {
        $this->_data = parent::GetFormDataFromJSON("Data");
    }


    protected function WriteFormSettings()
    {
        $this->_settings = parent::GetFormSettingsFromJSON("Settings");
    }


    protected function WriteKeywords()
    {
        $this->_keywords = parent::GetValidationKeywordsFromJSON("keywords");
    }

    protected function WriteErrors(string $filename)
    {
        $this->_errors = parent::GetValidationErrorsFromJSON($filename);
    }


    protected function WriteAllowedKeys()
    {
        $this->_formKeys = parent::GetFormKeys("allowed");
    }

    protected function WriteKey(string $key)
    {
        $this->_key = $key;
    }

    protected function WriteValue(string $value)
    {
        $this->_value = $value;
    }


    protected function GetFormData()
    {
        if (!empty($this->_data)) {
            return $this->_data;
        } else {
            throw new Exception("Warning: Form data has not been initialised");
        }
    }



    protected function GetForm()
    {
        if (!empty($this->_form)) {
            return $this->_form;
        } else {
            throw new Exception("Warning: Form has not been initialized");
        }
    }



    protected function GetFormSettings()
    {
        if (!empty($this->_settings)) {
            return $this->_settings;
        } else {
            throw new Exception("Warning: Form data settings have not been initialized");
        }
    }


    protected function GetKeywords()
    {
        if (!empty($this->_keywords)) {
            return $this->_keywords;
        } else {
            throw new Exception("Warning: Keywords have not been initialised");
        }
    }



    protected function GetErrors()
    {
        if (!empty($this->_errors)) {
            return $this->_errors;
        } else {
            throw new Exception("Warning: Errors have not been initialised");
        }
    }


    protected function GetRules()
    {
        if (!empty($this->_rules)) {
            return $this->_rules;
        } else {
            throw new Exception("Warning: Rules have not been initialized");
        }
    }


    protected function GetKey()
    {
        if (!empty($this->_key)) {
            return $this->_key;
        } else {
            throw new Exception("Warning: Form key has not been initialized");
        }
    }

    protected function GetValue()
    {
        if (!empty($this->_value)) {
            return $this->_value;
        } else {
            throw new Exception("Warning: Form value has not been initialized");
        }
    }


    protected function GetAllowedKeys()
    {
        if (!empty($this->_formKeys)) {
            return $this->_formKeys;
        } else {
            throw new Exception("Form keys have not been defined");
        }

    }








}