<?php

namespace Vendor\Services\Routes;

use Vendor\Services\Data\Data;
use Vendor\Services\Exceptions\RouteServiceExceptions;
use Vendor\Services\Routes\Route;
use Vendor\Services\Routes\Route as RouteServiceProvider;
use Vendor\Services\Server\Server;
use Vendor\Services\Sessions\Session;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Sat May 27 2023 03:19:46 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Route Service Provider(RSP) Configuration 
 */
abstract class RouteServiceConfiguration extends RouteServiceExceptions
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN ROUTE SERVICE PROVIDER (RSP) CONFIGURATION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### RSP service registrar
     * - This property stores an instance of RSP interface (Route::class)
     * - This allows us to access non static RSP methods from static context
     * @var object|null $instance
     */
    private static $instance = null;

    /**
     * #### Routes Registrar.
     * - This property handles routes registered in Route Session Config
     * @depends Vendor\Services\Sessions\Models\SessionServiceHandlers::GetStoredRoutes()
     * @var array $routes
     */
    private array $routes = [];

    /**
     * #### Route registrar
     * This property stores a client defined route
     * @var string $route
     */
    private string $route = "";

    /**
     * #### Route Request Method Registrar
     * - This property stores a route's request method
     * @var string $routeRequestMethod
     */
    private string $routeRequestMethod = "";
    /**
     * #### Route Log Data Registrar 
     * - This property registers all log data generated via URI requests
     * @var array|string
     */
    private array|string $routeLogData = "";


    /**
     * #### Base URI registrar
     * - This property stores the absolute URI path supplied by client request
     * @var string $baseURI
     */
    private string $baseURI = "";

    /**
     * #### URI registrar
     * - This property stores the relative URI path supplied by client request 
     */
    private string $uri = "";

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN RSP BOOT CONFIGURATION SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Register RSP interface
     * - This methods registers an RSP interface service instance to RSP service registrar
     * @param Route $route - A Route instance  
     */
    public static function getInstance(Route $route)
    {
        if (!isset(self::$instance)) {
            self::$instance = $route;
        }
        return self::$instance;
    }

    /**
     * #### Reset RSP instance Registrar
     * - This method resets RSP instance registrar to default 
     */
    public static function resetInstance()
    {
        self::$instance = null;
    }

    /**
     * #### Boot Route Service Provider Interface
     * - This method registers an instance of RSP interface to the Route Instance Registrar
     * - This allows us to access RSP non static methods from static context
     * @return object|null
     */
    public static function boot(): RouteServiceProvider
    {
        return self::getInstance(new RouteServiceProvider());
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END RSP BOOT SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |SERVER METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Client URI
     * - This method gets the client requested URI supplied on the browser
     * @return string
     */
    protected function getClientURI()
    {
        return Server::get("request/uri");
    }

    /**
     * #### Client Request Method
     * - This method gets the client's server request method
     * @return string
     */
    protected function getClientRequestMethod()
    {
        return Server::get("request/method");
    }

    /**
     * ##### Client Port
     * - This method gets the client's listening port
     * @return string;
     */
    protected function getClientPort()
    {
        return Server::get("request/client-port");
    }

    /**
     * #### Client Query String
     * - This method gets any query strings supplied in client URI
     */
    protected function getClientQueryString()
    {
        return Server::get("request/query-string");
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END SERVER METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN GETTER & SETTERS 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
   */

    /**
     * #### Get Route
     * - This method returns a registered route stored by Route Registrar 
     * @return string
     */
    protected function getRoute()
    {
        return $this->route;
    }

    /**
     * #### Register route
     * - This method registers a new route to the route service configuration provider.
     * @param string $route A defined route
     * @return self
     */
    protected function setRoute(string $route): void
    {
        $this->route = $route;
        $this->setRoutes($this->route);
        return;
    }


    /**
     * #### Reset Route Registrar
     * - This method sets back the route registrar to its default value
     * @return void
     */
    protected function unsetRoute()
    {
        $this->route = null;
        return;
    }

    /**
     * #### Get routes from route session
     * - This method gets all routes from route session and registers them to routes registrar
     * @return void
     */
    protected function setRoutes(string $route)
    {
        $this->routes[] = $route;
        return;
    }

    /**
     * #### Get Routes.
     * - This method gets all registered routes in routes registrar. 
     * - The method returns an empty array if no routes have been found
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * #### Register Request Method
     * This method registers client's server request method to route request method registrar
     * @param string $routeRequestMethod Register Request method
     * @return void
     */
    protected function setRouteRequestMethod(string $routeRequestMethod): void
    {
        $this->routeRequestMethod = $routeRequestMethod;
        return;
    }

    /**
     * #### Get registered request method
     * - This method returns a route's registered request method. 
     * - Valid request methods include; GET, POST, PUT, PATCH, DELETE
     * @return string
     */
    protected function getRouteRequestMethod()
    {
        return $this->routeRequestMethod;
    }


    /**
     * Register log data to route log data registrar
     * This method registers route log data to the route log data registrar. 
     * Registered log data can be a string or an array. In the case of an array,
     * the logGenerator::class helper breaks the array into key value pairs. 
     * @param array|string $routeLogData Generates route log data
     * @return void
     */
    protected function setRouteLogData(array|string $routeLogData): void
    {
        $this->routeLogData = $routeLogData;
        return;
    }

    /**
     * Generates route log data.
     * This method returns log data present in the log data registry.
     * If log data is empty, it returns an empty string 
     * @return array|string
     */
    protected function getRouteLogData()
    {
        return $this->routeLogData;
    }


    /**
     * #### Get Base URI
     * - This method gets a registered base URI from base URI registrar
     * @return string
     */
    protected function getBaseURI()
    {
        return $this->baseURI;
    }

    /**
     * #### Register Base URI
     * - This method registers a clients request relative URI to base URI registrar
     * @param string $baseURI - Base URI registrar
     * @return self
     */
    protected function setBaseURI(string $clientURI): self
    {
        $this->baseURI = $clientURI;
        return $this;
    }

    /**
     * #### Get registered URI
     * - This method gets a registered URI from URI registrar
     * @return mixed
     */
    protected function getURI()
    {
        return $this->uri;
    }

    /**
     * #### Register URI
     * - This method registers client request absolute URI to the URI registrar
     * @param string $uri - URI registrar
     * @return void
     */
    protected function setURI(string $uri)
    {
        $this->uri = $uri;
        return;
    }

    /**
     * #### Get Route from Query string
     * - This method separetes the absolute URI route from any set query strings and returns the route
     * @return string
     */
    protected function getRouteFromQueryString(string $uri)
    {
        return Data::stringOrArrayReplace([$this->getClientQueryString(), "?"], "", $uri);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    |END GETTERS AND SETTERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END ROUTE SERVICE PROVIDER (RSP) CONFIGURATION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}