<?php


namespace Vendor\Services\Sessions;

use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Exceptions\SessionServiceExceptions;
use Vendor\Services\Sessions\Session as InterfaceSSP;
use Vendor\Services\Sessions\SessionServiceProvider as BaseSSP;

/**
 * @author Peter Mwambi
 * @date Fri Jun 02 2023 21:55:39 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Authentication\Sessions
 * @abstract Session Serive Provide Configuration (SSPC) model. 
 * Defines properties and methods for session service configuration
 */
abstract class SessionServiceConfiguration extends SessionServiceExceptions
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN SESSION SERVICE PROVIDER CONFIGURATION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### SSP interface service Registrar
     * This proprerty stores an instance of the SSP ineterface service class
     */
    private static $instance = null;

    /**
     * #### Session Name Registrar
     * - This property stores the name of a configured session
     * @var string $sessionName - The session name
     */
    private $sessionName = "";

    /**
     * #### Session value registrar
     * - This property stores the value of a configured session
     * @var string|array $sessionValue - The session value
     */
    private $sessionValue = null;

    /**
     * #### Session type registrar
     * - This property stores the type of session being configured
     * - Session types can either be string types or array types
     * @param string $sessonType - The session type 
     */
    private $sessionType = "string";
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN GETTERS AND SETTERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /**
     * #### Set session name
     * - This method registers a configured session name to the session name registrar.
     * - This allows us to access the set session by its name
     * @param string $name - The configured session name
     * @return void
     */
    public function setSessionName(string $name)
    {
        $this->sessionName = $name;
        return;
    }

    /**
     * #### Get session name
     * - This method gets a set session registered by the session registrar
     * - The method is useful when accessing a defined session by name
     * @return string
     */
    protected function getSessionName()
    {
        return $this->sessionName;
    }

    /**
     * #### Set session value
     * - This method registers the value of a defined session to the session value registrar
     * @param array|string $value - The defined session value
     * @return void
     */
    public function setSessionValue(string|array $value)
    {
        $this->sessionValue = $value;
        return;
    }

    /**
     * #### Get session value 
     * - This method retrieved a registered session value from the session value registrar.
     * @return array|string
     */
    protected function getSessionValue()
    {
        return $this->sessionValue;
    }

    /**
     * #### Set session type
     * - This method registers client defined session type to the sesson registrar. 
     * - Types define the data to be stored and the manner in which they will be stored in the session. 
     * - Types can be of the following formats
     * 1. string - binds string data as session value to a session name
     * 2. array - push string or array data as session value to session array identified by name
     * @return void; 
     */
    public function setSessionType(string $type)
    {
        $this->sessionType = $type;
        return;
    }

    /**
     * #### Get session type
     * - This method retrieves a defined session type from the session registrar
     * @return string|array
     */
    protected function getSessionType()
    {
        return $this->sessionType;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END GETTERS AND SETTERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN BOOT SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * Resister SSP service interface to the SSP service registrar
     * This method registers an SSP service interface to the SSP service 
     * registrar and allows us to access SSP service non static methods from
     * a non static context
     * @param object $sspInstace - The SSP service Instance
     * @return object
     */
    public static function instance(object $sspInstance)
    {
        if (!isset(self::$instance)) {
            self::$instance = $sspInstance;
        }
        return self::$instance;
    }

    /**
     * #### Boot SSP Interface
     * - This method register an instance of SSP interface to the SSP instance registrar
     * @return InterfaceSSP
     */
    public static function boot()
    {
        return BaseSSP::instance(new InterfaceSSP());
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END BOOT SERVICE PROVIDER
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN SERVICE METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Get get stored session by name.
     * - This method attempts to fetch a defined session from the session array by its name. 
     * - If the session name which is an array key in the $_SESSION variable is found, it returns the session value 
     * - Otherwise The method throws an invalid argument sessionNotFound exception
     * @return array|string|void
     * @throws \Vendor\Services\Exceptions\SessionServiceExceptions
     */
    private function getStoredSession()
    {
        if (BaseSSP::exists($this->getSessionName())) {
            return BaseSSP::get($this->getSessionName());
        }
        return parent::throwSessionNameNotFoundException($this->getSessionName());
    }

    /**
     * #### Get stored session name
     * - This method retrieves a registered session from the session registrar and returns the session name
     * @return string
     */
    public function getStoredSessionName()
    {
        return $this->getStoredSessionName()["session-name"];
    }

    /**
     * #### Get stored session value
     * - This method retrieves a registered session from the session registrar and returns the session value
     * @return string|array
     */
    public function getStoredSessionValue()
    {
        return ($this->getStoredSession()["session-value"]);
    }

    /**
     * #### Get stored session handler
     * - This method retreives a registered session from the session registrar and returns the session handler
     * @return string
     */
    public function getStoredSessionHandler()
    {
        return $this->getStoredSession()["session-handler"];
    }

    /**
     * #### Get stored session passkey
     * - This method retreives a registered session from the session registrar and returns the session passkey
     * @return string
     */
    public function getStoredSessionPassKey()
    {
        return $this->getStoredSession()["session-passkey"];
    }

    protected function getRouteHandlerSessionName()
    {
        return Configuration::app("route-session-handler");
    }

    protected function getRouteHandlerSessionPassKey()
    {
        return Configuration::app("route-session-passkey");
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END SERVICE METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SESSION SERVICE PROVIDER CONFIGURATION
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}