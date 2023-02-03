<?php

namespace Models\Core\App\Routes\Shell;

use Exception;
use Models\Auth\Input;
use Models\Core\App\Routes\Kernel\Config;
use Models\Core\App\Routes\Kernel\Handler;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @package Routes
 * @date Sat Dec 31 2022 08:36:58 GMT+0300 (East Africa Time)
 * @updated Sat Dec 31 2022 08:36:58 GMT+0300 (East Africa Time) 
 */
class Dispatch extends Register
{


    private $_handler;

    private $_request;

    private $_routes;

    private $_route;


    public function __construct()
    {
        $this->_handler = new Handler;
    }
    public function VerifyRoute()
    {
        $this->_request = $this->_GetRequest();
        $this->_routes = $this->_GetRoutes();
        if (array_key_exists($this->_request, (array) $this->_routes)) {
            $request = $this->_request;
            $this->_SetRouteParams($this->_routes->$request);
            return true;
        } else {
            $this->_SetResponseCode(404);
            return false;
        }
    }

    public function VerifyRequest()
    {
        $methods = $this->_GetRouteMethods();
        if (in_array($_SERVER["REQUEST_METHOD"], $methods)) {
            return true;
        } else {
            throw new Exception("Warning: Invalid request method");
        }
    }

    public function VerifyParams(string $param, string $paramName)
    {
        $getParams = $this->_GetRouteRequestParams($paramName);
        foreach (Input::GetParams($param) as $param) {
            if (!array_key_exists($param, $getParams)) {
                $this->_SetResponseCode(400);
                throw new Exception("Warning: {$param} does not exist");
            }
        }
    }


    public function ProcessRoute()
    {
        $method = "Get" . $this->_GetRouteFunction();
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }


    public function RedirectTo404()
    {
        if ($this->_GetResponseCode() === 404) {
            parent::Get404page();
        } else {
            throw new Exception("Warning: Call to an uncalled response" . $this->_GetResponseCode());
        }
    }


    private function _GetRequest()
    {
        return $this->_handler->GetRequest();
    }

    private function _GetRoutes()
    {
        $config = new Config;
        return $config->GetRouteConfig();
    }




    /**
     * Summary of _GetRouteParams
     * @return object
     */
    private function _GetRouteParams()
    {
        if (isset($this->_route)) {
            return $this->_route;
        } else {
            throw new Exception("Warning: Route has not been set");
        }
    }

    private function _SetRouteParams(mixed $route)
    {
        $this->_route = $route;
    }


    private function _GetRouteMethods()
    {
        return $this->_GetRouteParams()->methods;
    }

    private function _GetRouteFunction()
    {
        return ($this->_GetRouteParams()->function);
    }

    private function _GetRouteRequestParams(string $paramName)
    {
        return $this->_GetRouteParams()->$paramName;
    }
    private function _SetResponseCode(int $code)
    {
        return http_response_code($code);
    }

    private function _GetResponseCode()
    {
        return http_response_code();
    }

}