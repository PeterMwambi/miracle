<?php


namespace Models\Core\Services\Ajax\Shell;

use Exception;
use Models\Core\App\Cache\Storage;
use Models\Core\App\Database\Writer\Write;
use Models\Core\Services\Ajax\Kernel\Request;

final class Service extends Request
{


    private $_message = array();

    private $_data = array();

    private $_rules = "";

    private $_errors = "";

    private $_action = "";

    private $_method = "";

    private $_finalSuccessMessage = "";

    private $_finalErrorMessage = "";

    private $_nextAction = "";

    private $_finalMethod = "";

    public function WriteData(array $data)
    {
        $this->_data = $data;
        return;
    }
    public function WriteRulePath(string $path)
    {
        $this->_rules = $path;
        return;
    }

    public function WriteErrorPath(string $path)
    {
        $this->_errors = $path;
        return;
    }

    public function WriteAction(string $action)
    {
        $this->_action = $action;
        return;
    }

    public function WriteMethod(string $method)
    {
        $this->_method = $method;
        return;
    }

    public function WriteFinalErrorMessage(string $message)
    {
        $this->_finalErrorMessage = $message;
        return;
    }


    public function WriteFinalSuccessMessage(string $message)
    {
        $this->_finalSuccessMessage = $message;
        return;
    }

    public function WriteNextAction(string $next)
    {
        $this->_nextAction = $next;
        return;
    }


    public function WriteFinalMethod(string $method)
    {
        $this->_finalMethod = $method;
        return;
    }


    public function RunService()
    {
        return $this->_RunService();
    }

    private function _RunService()
    {
        $this->_LoadData();
        if (count($this->_data)) {
            parent::WriteRules($this->_rules);
            parent::WriteErrors($this->_errors);
            parent::SetFormData($this->_data);
            if (parent::Validate()) {
                $this->_AssignToService($this->_action, $this->_data, $this->_finalSuccessMessage, $this->_finalErrorMessage, $this->_nextAction);
            } else {
                $this->_GenerateMessage(parent::GetErrorMessage(), 0);
            }
        }
        $this->_DisplayMessage();
        return;
    }

    private function _GenerateMessage(string $message, int $flag, string $next = null)
    {
        if (!empty($next)) {
            $this->_message = array("message" => $message, "flag" => $flag, "next" => $next);
            return;
        } else {
            $this->_message = array("message" => $message, "flag" => $flag);
            return;
        }
    }

    private function _DisplayMessage()
    {
        if (count($this->_message)) {
            echo json_encode($this->_message);
            return;
        } else {
            throw new Exception("Warning: No messages found");
        }
    }
    private function _LoadData()
    {
        switch (parent::GetForm()) {
            case parent::GetForm():
                $this->_rules = $this->_GetRulePath();
                $this->_errors = $this->_GetErrorPath();
                $this->_action = $this->_GetAction();
                $this->_method = $this->_GetMethod();
                $this->_finalSuccessMessage = $this->_GetFinalSuccessMessage();
                $this->_finalErrorMessage = $this->_GetFinalErrorMessage();
                $this->_data = $this->_GetData();
                $this->_nextAction = $this->_GetNextAction();
                break;
        }
    }

    private function _AssignToService(string $action, array $data, string $successMessage, string $errorMessage, string $next = null)
    {
        switch ($action) {
            case "StoreToCache":
                $method = $this->_method;
                $storage = new Storage;
                if (method_exists($storage, $method)) {
                    Storage::$method(array(parent::GetForm() => $data));
                    if ($this->_CheckIfStepIsFinal($next)) {
                        $writer = new Write;
                        $writer->WriteData(Storage::GetCachedData());
                        if ($this->_RunFinalMethod($writer)) {
                            $this->_GenerateMessage($successMessage, 1, $next);
                            return;
                        } else {
                            $this->_GenerateMessage($errorMessage, 0);
                            return;
                        }
                    }
                    $this->_GenerateMessage($successMessage, 1, $next);
                    return;
                } else {
                    $this->_GenerateMessage($errorMessage, 0);
                }
                break;
        }
        return;
    }


    private function _RunFinalMethod(object $class)
    {
        if ($this->_ValidateFinalMethod($class)) {
            $method = $this->_GetFinalMethod();
            return $class->$method();
        } else {
            return false;
        }
    }

    private function _ValidateFinalMethod(object $class)
    {
        if (method_exists($class, $this->_GetFinalMethod())) {
            return true;
        } else {
            return false;
        }
    }

    private function _CheckIfStepIsFinal(string $step)
    {
        if ($step === "GoToFinalStep") {
            return true;
        } else {
            return false;
        }
    }


    private function _GetFinalMethod()
    {
        if (!empty($this->_finalMethod)) {
            return $this->_finalMethod;
        } else {
            throw new Exception("Final method has not been declared");
        }
    }


    private function _GetFinalErrorMessage()
    {
        if (!empty($this->_finalErrorMessage)) {
            return $this->_finalErrorMessage;
        }
    }

    private function _GetFinalSuccessMessage()
    {
        if (!empty($this->_finalSuccessMessage)) {
            return $this->_finalSuccessMessage;
        }
    }


    private function _GetMethod()
    {
        return $this->_method;
    }


    private function _GetAction()
    {
        if (!empty($this->_action)) {
            return $this->_action;
        }
    }


    private function _GetNextAction()
    {
        if (!empty($this->_nextAction)) {
            return $this->_nextAction;
        }
    }



    private function _GetData()
    {
        if (count($this->_data)) {
            return $this->_data;
        }
    }



    private function _GetRulePath()
    {
        if (!empty($this->_rules)) {
            return $this->_rules;
        }
    }

    private function _GetErrorPath()
    {
        if (!empty($this->_errors)) {
            return $this->_errors;
        }
    }


}