<?php

namespace Models\Core\Services\Ajax\Kernel;

use Controllers\Controller;
use Models\Auth\Hashing;

class Security extends Controller
{

    private $_formIdentifier;

    private $_form;



    public function SetFormIdentifier(string $identifier)
    {
        parent::WriteAllowedKeys();
        $this->_formIdentifier = $identifier;
    }
    private function _DecryptedFormIdentifier()
    {
        $this->_formIdentifier = Hashing::Decrypt($this->_formIdentifier);
        return $this->_formIdentifier;
    }
    public function VerifyFormIdentifier()
    {
        $identifier = $this->_DecryptedFormIdentifier();
        $identifiers = parent::GetAllowedKeys();
        if (array_key_exists($identifier, (array) $identifiers)) {
            $this->_form = $identifiers->$identifier;
            return true;
        } else {
            return false;
        }
    }

    public function GetForm()
    {
        return $this->_form;
    }


}