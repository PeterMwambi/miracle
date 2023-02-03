<?php

namespace Models\Core\App\Routes\Kernel;

use Exception;
use Models\Auth\Sanitize;


final class Handler
{

    private $_url;

    private $_prefix;

    private $_request;


    public function __construct()
    {
        $this->_SetUrl();
        $this->_SetPrefix();
    }

    private function _SetPrefix()
    {
        $config = new Config;
        $this->_prefix = $config->GetRoutePrefix();
    }

    public function GetRequest()
    {
        $this->_SetRequest();
        return Sanitize::String(trim($this->_request));
    }

    private function _SetRequest()
    {
        $prefix = $this->_GetPrefix();
        $url = $this->_GetUrl();
        $this->_request = str_replace($prefix, "", $url["path"]);
    }

    private function _SetUrl()
    {
        $this->_url = parse_url($_SERVER["REQUEST_URI"]);
    }

    private function _GetUrl()
    {
        if (count((array) $this->_url)) {
            return $this->_url;
        } else {
            throw new Exception("Warning: URI has not been set");
        }
    }

    private function _GetPrefix()
    {
        if (isset($this->_prefix)) {
            return $this->_prefix;
        } else {
            throw new Exception("Warning: URI prefix has not been set");
        }
    }

}