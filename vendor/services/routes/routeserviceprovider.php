<?php

namespace Vendor\Services\Routes;

use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Data\Data;
use Vendor\Services\File\File;
use Vendor\Services\Headers\Header;
use Vendor\Services\Server\Server;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Tue May 30 2023 22:15:03 GMT+0300 (East Africa Time)
 * @package Vendor\Services\Routes
 * @version miracle v1.2.0
 * @abstract Route Service Provider(RSP) RSP Model.
 * This class handles all routing processes.
 */
abstract class RouteServiceProvider extends RouteServiceConfiguration
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN ROUTE SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN ROUTE SETUP SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
 |`````````````````````````````````````````````````````````````````````````````````````````````````````
 |BEGIN SERVICE METHODS
 |`````````````````````````````````````````````````````````````````````````````````````````````````````
 */

    /**
     * #### Register GET request method
     * - This method registers a GET request to the route request method registrar
     * @return void
     */
    protected function registerGetMethod()
    {
        $this->setRouteRequestMethod("GET");
        return;
    }

    /**
     * #### Register POST request method
     * - This method registers a POST request to the route request method registrar
     * @return void
     */
    protected function registerPostMethod()
    {
        $this->setRouteRequestMethod("POST");
        return;
    }




    /**
     * #### Execute route callback
     * - This method executes a user defined callback assigned to a route
     * @param callable $callback - A user defined function
     */
    protected function executeCallBack(callable $callback)
    {
        return $callback();
    }



    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END SERVICE METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN ROUTE SETUP SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN ROUTE LOG HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */



    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN ROUTE LOG REPORT HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Get failed request report log
     * This method defines a customised error log to be genereted whenever we 
     * encounter failed requests during routing.
     * @return array
     */
    public function failedRequestLogData()
    {
        $logData = [
            "client-ip" => Server::get("request/remote-ip"),
            "server-ip" => Server::get("request/server-ip"),
            "method" => Server::get("request/method"),
            "uri" => Server::get("request/uri"),
            "handler" => Server::get("request/handler"),
            "query-string" => Server::get("request/query-string"),
            "client-port" => Server::get("request/client-port"),
            "server-port" => Server::get("request/server-port"),
            "protocol" => Server::get("request/scheme"),
            "browser" => Server::get("request/browser-type"),
            "status" => Server::httpResponseCode(),
            "request-file-formats" => Server::get("request/file-formats"),
            "time" => Server::get("request/time"),
        ];
        return $logData;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE LOG REPORT HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN ROUTE LOG HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Get request log file. 
     * - This method checks the request type and returns the respective log file
     * - Request types include: 
     * 1. successful-requests - Routes that respond with a 200 status code 
     * 2. failed-requests - Routes that respond with 404 status code
     * @param string $type - Request type
     * @return string|void  
     */
    protected function getRequestLogFile(string $type)
    {
        switch ($type) {
            case "successful-request":
                return "requests/successful.log";
            case "failed-request":
                return "requests/failed.log";
        }
        return;
    }

    /**
     * #### Write to log file. 
     * - This method writes to the log files for both successful and failed requests.
     * - Log file messages can be server defined or customised by the client.
     * - Customised messages can written in RSP messages. 
     * - The method return Server configured request messages by default
     * @return void
     * @extends 
     */
    protected function generateServerLog(string $type, array $data = [])
    {
        if (count($data)) {
            $this->setRouteLogData($data);
        } else {
            $this->setRouteLogData(Server::get("request"));
        }
        File::writeLog($this->getRequestLogFile($type), $this->getRouteLogData());
    }

    /**
     * ##### Generate Error Log
     * - This method gets a customized error log message and binds it to the error log writer
     * @depends Vendor\Services\Routes\RouteServiceConfiguration::generateServerLog
     */
    public function generateErrorLog()
    {
        $this->generateServerLog("failed-request", $this->failedRequestLogData());
        return;
    }


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE LOG HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE LOG SERVICE HANDLERS 
    |``````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */



    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | ROUTE SECURITY SERVICE HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | ROUTE FORMATTING HANDLERS 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Format client URI
     * - This method gets the absolute route URI.
     * - The method removes the relative URI handler, and any attached query strings then returns the absolute URI name
     * - For example https://miracle.com/pages/home?  returns home, https://miracle.com/products?cat=tech&id=23433 returns products
     * - This method helps us bind a request to its call back 
     * @return string 
     */
    public function formatURI(): string
    {
        $this->setBaseURI(Data::stringOrArrayReplace(strtolower(Configuration::app("root-directory")), "", strtolower(parent::getClientURI())));
        $this->setURI($this->hasQueryString() ? $this->getRouteFromQueryString($this->getBaseURI()) : $this->getBaseURI());
        return $this->getURI();
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE FORMATTING HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | ROUTE RESPONSE MESSAGE HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Generate 404 feedback
     * - This method generates a 404 error code
     * - This method is useful when redirecting users to a custom error page when a requested URL has not been found
     * @return false
     */
    public function generate404Feedback(): bool
    {
        Server::get()->throw404Error();
        return false;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE RESPONSE MESSAGE HANDLERS  
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | ROUTE VERIFICATION HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * @todo Write route error handlers to an external route log file
     */

    /**
     * #### Verify exists query string
     * - This method checks if client supplied route contains a query string
     * @return bool;
     */
    protected function hasQueryString(): bool
    {
        if (!empty($this->getClientQueryString())) {
            return true;
        }
        return false;
    }

    /**
     * #### Verify route
     * - This method verifies if client supplied route exists in route session regiatrar
     * @param string $route - The searched route
     * @return bool
     * @throws \RuntimeException
     */
    public function verifyRouteInRoutes(string $route): bool
    {
        if (in_array($route, parent::getRoutes())) {
            return true;
        }
        return false;
    }

    /**
     * #### Verify client request method
     * - This method verifies the request method assigneed to a route 
     * - If the request method is valid, the method approves the request
     * - If the request method is invalid, the method denies the request and throws a 404 error
     * @return bool
     * @throws \ErrorException
     */
    public function verifyRequestMethod(): bool
    {
        if (parent::getClientRequestMethod() === parent::getRouteRequestMethod()) {
            return true;
        }
        return $this->generate404Feedback();
    }

    /**
     * #### Verify URI matches a defined Route
     * - This method check if the requested absolute URI matches a registered route
     * - If a match is found the method returns true and propmts the call back execution
     * - If a match is not found, the method exits
     * @return bool
     */
    protected function verifyURIMatchesDefinedRoute(): bool
    {
        if ($this->formatURI() === $this->getRoute()) {
            return true;
        }
        return false;
    }

    /**
     * #### Verify Protocol is HTTPS
     * - This method checks if the client request protocol scheme is https
     * - If the requested scheme is HTTPS the method allows route callback execution
     * - If the scheme is not https the method returns an error with a 404 status
     */
    public function verifyProtocolIsHTTPS()
    {
        if (Server::get()->verifyProtocolIsHTTPS()) {
            return true;
        } else {
            return $this->generate404Feedback();
        }
    }

    /**
     * #### Verify Route URI
     * - This method verifies:
     * 1. The absolute URI that sent the request
     * 2. The protocol used for the request
     * - If URI does not match the defined route, the method exits
     * - If protocol scheme is not https, the method exits. 
     * @return bool
     */
    public function verifyRouteURI(): bool
    {
        if (
            $this->verifyURIMatchesDefinedRoute() &&
            $this->verifyProtocolIsHTTPS()
        ) {
            return true;
        }
        return false;
    }


    /**
     * #### Verify 200 Response Code
     *  - This method verifies if a server request has returned a status code of 200
     *  - The method is useful for filtering failed requests from successful requests
     * @return bool
     */
    public function verify200ResponseCode(): bool
    {
        if (Server::httpResponseCode() === 200) {
            return true;
        }
        return false;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE VERIFICATION HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | ROUTE SECURITY HANDLERS 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Verify valid route
     * - This method performs final route verification
     * - The method binds together all route verification methods to allow route filtering
     * @return bool
     */
    protected final function verifyValidRoute(): bool
    {
        if (
            $this->verifyRequestMethod() &&
            $this->verifyRouteURI() &&
            $this->verify200ResponseCode()
        ) {
            $this->generateServerLog("successful-request");
            return true;
        }
        return false;
    }

    /**
     * #### Deny all invalid
     * - This method handles all failed requests
     * - The method bundles together all verification methods and filters client URI
     * @return bool
     */
    public final static function denyAllInvalid(): bool
    {
        if (
            !self::boot()->verifyRouteInRoutes(self::boot()->formatURI()) ||
            !Server::get()->verifyProtocolIsHTTPS()
        ) {
            self::boot()->generate404Feedback();
            self::boot()->generateErrorLog();
            Header::redirect("https://" . Server::get("request/host") . Configuration::app("root-directory") . Configuration::app("default-error-route"));
            return false;
        }
        return false;
    }
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE SECURITY HANDLERS 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE SECURITY SERVICE HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */




    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | ROUTE REQUEST SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Route service
     * - This method gets a named root from client code and binds it to a defined callback.
     * - The method registers a route to the route registrar 
     * - The method then executes a call back passed to it as the second argument.
     * @param string $route - The named route
     * @param callable $callback - A user defined function  
     * @return bool
     */
    private function routeService(string $route, callable $callback): bool
    {
        $this->setRoute($route);
        if ($this->verifyValidRoute()) {
            $this->executeCallBack($callback);
            return true;
        }
        return false;
    }

    /**
     * ##### Boot GET service
     * - This method registers GET requests to request handlers  
     * - This method only handles GET requests and as such any dissimalar requests will not be executed
     * @param string $route - The named route
     * @param callable $callback - A user defined function  
     * @return bool
     */
    public function runGetService(string $route, callable $callback): bool
    {
        $this->registerGetMethod();
        return $this->routeService($route, $callback);
    }

    /**
     * #### Boot POST service
     * - This method registers POST requests to request handlers  
     * - This method only handles POST requests and as such any dissimalar requests will not be executed
     * @param string $route - The named route
     * @param callable $callback - A user defined function  
     * @return bool
     */
    public function runPostService($route, callable $callback): bool
    {
        $this->registerPostMethod();
        return $this->routeService($route, $callback);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE REQUEST SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | END ROUTE SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}