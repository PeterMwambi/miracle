<?php

namespace Models\Core\Services\Ajax\Kernel;

use Models\Core\App\Validation\Shell\Gateway as ValidationGateway;

use Exception;

class Request extends Security
{

    private array $_formData;


    private $_validationHandler;
    public function __construct()
    {
        $this->_validationHandler = new ValidationGateway;
        return;
    }

    public function SetFormData(array $data)
    {
        $this->_formData = $data;
        return;
    }

    public function Validate()
    {
        $this->_validationHandler->RunRequest($this->_formData);
        if ($this->_validationHandler->Confirm()) {
            return true;
        } else {
            return false;
        }
    }

    public function GetErrorMessage()
    {
        return $this->_validationHandler->GetErrorMessage();
    }

    public function WriteRules(string $rules)
    {
        $this->_validationHandler->WriteRules($rules);
        return;
    }

    public function WriteErrors(string $errors)
    {
        $this->_validationHandler->WriteErrors($errors);
    }

}