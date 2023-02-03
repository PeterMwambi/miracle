<?php

namespace Models\Core\App\Helpers;

use Exception;


class Writer
{

    private $_array = array();

    private $_keys = array();

    private $_newKeys = array();


    private function _SetArray(array $array)
    {
        $this->_array = $array;
    }


    private function _GetArray()
    {
        if (count($this->_array)) {
            return $this->_array;
        } else {
            throw new Exception("Warning: Array has not been defined");
        }
    }


    private function _WriteArrayKeys()
    {
        $this->_keys = array_keys($this->_GetArray());
    }

    private function _GetArrayKeys()
    {
        if (count($this->_keys)) {
            return $this->_keys;
        } else {
            throw new Exception("Warning: Array keys have not been defined");
        }
    }

    private function _WriteNewArrayKeys(array $keys)
    {
        $this->_newKeys = $keys;
    }


    private function _GetNewArrayKeys()
    {
        if (count($this->_newKeys)) {
            return $this->_newKeys;
        } else {
            throw new Exception("Warning: No new array keys were defined");
        }
    }

    private function _ReplaceOldArrayKeysWithNew()
    {
        $this->_keys = array_replace($this->_GetArrayKeys(), $this->_GetNewArrayKeys());
    }

    private function _GetNewArray()
    {
        $this->_ReplaceOldArrayKeysWithNew();
        return (array_combine($this->_GetArrayKeys(), array_values($this->_GetArray())));
    }


    public function RunArrayWriter(array $array, array $keys)
    {
        $this->_SetArray($array);
        $this->_WriteArrayKeys();
        $this->_WriteNewArrayKeys($keys);
        return $this->_GetNewArray();
    }


}