<?php
namespace Models\Core\App\Validation\Kernel;

use Controllers\Controller;
use Exception;
use Models\Core\App\Database\Writer\Write as DatabaseWriter;
use Models\Core\App\Helpers\Formatter;

/**
 * @author Peter Mwambi
 * @content Validation Class
 * @time Wed Dec 30 2020 10:27:13 GMT+0300 (East Africa Time)
 * @updated on Sat Feb 20 2021 17:50:05 GMT+0300 (East Africa Time)
 * 
 * Next Version should make use of http response codes on errors
 */


class Service extends Controller
{

    private $_data = array();
    private $_passed = false;
    private $_errors = array();

    private $_rules;
    private $_specialCases = array();

    private $_case = array();

    private $_caseMethods = array();


    protected function SetData(array $data)
    {
        $this->_data = $data;
    }

    public function WriteRules(string $rules)
    {
        parent::WriteRules($rules);
    }

    public function WriteErrors(string $errors)
    {
        parent::WriteErrors($errors);
    }


    private function _GetData()
    {
        if (count($this->_data)) {
            return $this->_data;
        } else {
            throw new Exception("Warning: Form data is required");
        }
    }


    protected function Execute()
    {
        $data = $this->_GetData();
        $this->_rules = parent::GetRules();
        $errors = parent::GetErrors();
        foreach ($this->_rules as $key => $keywords) {
            foreach ($keywords as $keyword => $value) {
                switch ($keyword) {
                    case "required":
                        switch ($value) {
                            case true:
                                if (empty($this->_data[$key])) {
                                    $this->_BindError($errors->$key->$keyword);
                                    return;
                                }
                                break;
                            case false:
                                if (isset($keywords->any)) {
                                    if (count($keywords->any)) {
                                        $items = $keywords->any;
                                        $test = false;
                                        foreach ($items as $item) {
                                            if (!empty($data[$item])) {
                                                $test = true;
                                            }
                                        }
                                        if (!$test) {
                                            $this->_BindError($errors->$key->any);
                                            return;
                                        }
                                    }
                                } else {
                                    if (empty($data[$key])) {
                                        return;
                                    }
                                }
                                break;
                        }
                        break;

                    case "matches":
                        if (!empty($data[$key]) && $data[$key] !== $data[$value]) {
                            $this->_BindError($errors->$key->$keyword);
                            return;
                        }
                        break;
                    case "min":
                        if (isset($keywords->constant) && $keywords->constant === "int") {
                            if (!empty($data[$key]) && $data[$key] < $value) {
                                $this->_BindError($errors->$key->$keyword);
                                return;
                            }
                        } else {
                            if (!empty($data[$key]) && strlen($data[$key]) < $value) {
                                $this->_BindError($errors->$key->$keyword);
                                return;
                            }
                        }
                        break;
                    case "max":
                        if (isset($keywords->constant) && $keywords->constant === "int") {
                            if (!empty($data[$key]) && $data[$key] > $value) {
                                $this->_BindError($errors->$key->$keyword);
                                return;
                            }
                        } else {
                            if (!empty($data[$key]) && (strlen($data[$key]) > $value)) {
                                $this->_BindError($errors->$key->$keyword);
                                return;
                            }
                        }

                        break;
                    case "pattern":
                        if (!empty($data[$key]) && !preg_match($value, $data[$key])) {
                            $this->_BindError($errors->$key->$keyword);
                            return;
                        }
                        break;
                    case "constant":
                        if (!empty($data[$key]) && !filter_var($data[$key], $this->_GetConstant($value))) {
                            $this->_BindError($errors->$key->$keyword);
                            return;
                        }
                        break;
                    case "values":
                        if (!empty($data[$key]) && !in_array($data[$key], $value)) {
                            $this->_BindError($errors->$key->$keyword);
                            return;
                        }
                        break;
                    case "different":
                        foreach ($value as $item) {
                            if ($data[$key] === $data[$item]) {
                                $this->_BindError(ucfirst(str_replace("-", " ", $key)) . " cannot be the same as " . str_replace("-", " ", $item));
                                return;
                            }
                        }
                        break;
                    case "unique":
                        switch ($value) {
                            case true:
                                $this->_WriteSpecialCases([
                                    "username",
                                    "email",
                                    "password",
                                    "security-question-1",
                                    "security-answer-1",
                                    "security-question-2",
                                    "security-answer-2"
                                ]);
                                if (in_array($key, $this->_GetSpecialCases())) {
                                    $specialKey = $this->_ResolveKeyFromSpecialCase($data);
                                    $specialCase = $this->_ResolveMethodFromSpecialCase($data, $this->_rules);
                                }
                                $key = !empty($specialKey) ? $specialKey : $key;
                                $method = !empty($specialCase) ? $specialCase : $keywords->method;
                                if (is_array($method) && is_array($key)) {
                                    $dataValues = [];
                                    $dataKeys = [];
                                    foreach ($key as $item) {
                                        $dataKeys[] = $item;
                                        $dataValues[] = $data[$item];
                                    }
                                    $dataArray = Formatter::Run()->FormatArray($dataValues, $dataKeys);
                                    $this->_BindMethodToResolverFromArray($method, $dataArray, $dataKeys, $keywords, $keyword, $errors);
                                } else {
                                    $this->_ResolveMethodAndBindError($method, $data[$key], $key, $keywords, $keyword, $errors);
                                }

                                break;
                        }
                        break;
                }
            }
        }
    }


    private function _BindMethodToResolverFromArray(array $method, mixed $data, string|array $key, mixed $keywords, string $keyword, object $errors)
    {
        if (is_array($method)) {
            foreach ($method as $procedure) {
                $this->_ResolveMethodAndBindError($procedure, $data, $key, $keywords, $keyword, $errors);
            }
            return;
        }
    }

    private function _ResolveMethodToKey($method)
    {
        return match ($method) {
            "ValidatePassword" => "password",
            "ValidateUsername" => "username",
            "ValidateEmail" => "email",
            "ValidateSecurityQuestion1" => "security-question-1",
            "ValidateSecurityQuestion2" => "security-question-2",
            "ValidateSecurityAnswer1" => "security-answer-1",
            "ValidateSecurityAnswer2" => "security-answer-2",
        };
    }

    private function _ResolveMethodAndBindError(string|array $method, mixed $data, string|array $key, mixed $keywords, string $keyword, object $errors)
    {
        $writer = new DatabaseWriter;
        if (method_exists($writer, $method)) {
            $writer->WriteData($data);
            $writer->WriteExists($keywords->exists);
            if (!$writer->$method()) {
                if (is_array($key)) {
                    $item = $this->_ResolveMethodToKey($method);
                    $this->_BindError($errors->$item->$keyword);
                    return;
                } else {
                    $this->_BindError($errors->$key->$keyword);
                    return;
                }
            }
        } else {
            throw new Exception("Warning: Method was not found in object");
        }
    }

    private function _WriteSpecialCases(array $specialCases)
    {
        $this->_specialCases = $specialCases;
    }

    private function _GetSpecialCases()
    {
        if (count($this->_specialCases)) {
            return $this->_specialCases;
        } else {
            throw new Exception("Warning: Special cases have not been defined");
        }
    }


    private function _ResolveMethodFromSpecialCase(array $data, mixed $rules)
    {
        if (count($this->_specialCases)) {
            $keys = $this->_ResolveKeyFromSpecialCase($data);
            foreach ($keys as $key) {
                if (!empty($rules->$key->method)) {
                    $this->_caseMethods[] = $rules->$key->method;
                }
            }
            return array_unique($this->_caseMethods);
        } else {
            return null;
        }
    }


    private function _ResolveKeyFromSpecialCase(array $data)
    {
        foreach ($this->_GetSpecialCases() as $case) {
            if (!empty($data[$case])) {
                $this->_case[] = $case;
            }
        }
        return $this->_case;
    }

    private function _GetConstant(string $alias)
    {
        switch ($alias) {
            case "int":
                return FILTER_VALIDATE_INT;
            case "email":
                return FILTER_VALIDATE_EMAIL;
        }
    }

    private function _BindError(string $error)
    {
        $this->_errors[] = $error;
    }

    public function Confirm()
    {
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this->_passed;
    }

    public function GetErrorMessage()
    {
        if (count($this->_errors)) {
            foreach ($this->_errors as $error) {
                return $error;
            }
        }
    }

}