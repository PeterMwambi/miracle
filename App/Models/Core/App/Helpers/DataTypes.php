<?php

namespace Models\Core\App\Helpers;

use Exception;


class DataTypes extends Writer
{


    private $_string;


    private $_objectBoundary;

    private function _WriteObjectFromString(string $string)
    {
        $this->_string = $string;
        return;
    }


    private function _GetObjectFromString()
    {
        if (!empty($this->_string)) {
            return $this->_string;
        } else {
            throw new Exception("Warning: Object caller string has not been defined");
        }
    }

    private function _WriteObjectBoundary()
    {
        $this->_objectBoundary = explode("/", $this->_GetObjectFromString());
    }

    private function _GetObjectBoundary()
    {
        if (count($this->_objectBoundary)) {
            return $this->_objectBoundary;
        } else {
            throw new Exception("Warning: Object boundary array has not been defined");
        }
    }

    private function _Format(string $string, array $keys)
    {
        $this->_WriteObjectFromString($string);
        $this->_WriteObjectBoundary();
        return parent::RunArrayWriter($this->_GetObjectBoundary(), $keys);
    }


    protected function SetString(string $string)
    {
        $this->_string = $string;
    }

    private function _GetString()
    {
        if (!empty($this->_string)) {
            return $this->_string;
        } else {
            throw new Exception("Warning: Object String has not been defined");
        }
    }

    protected function RunFormatter(array $keys = [])
    {
        $array = count($keys) ? $keys : ["class", "method"];
        return ((object) $this->_Format($this->_GetString(), $array));
    }
    public function GetClass()
    {
        return $this->RunFormatter()->class;
    }

    public function GetMethod()
    {
        return $this->RunFormatter()->method;
    }

}