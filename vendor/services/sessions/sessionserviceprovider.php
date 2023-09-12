<?php

namespace Vendor\Services\Sessions;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @time Thu Sep 24 2020 09:56:28 GMT+0300 (East Africa Time)
 * @updated Sat Jun 03 2023 09:07:01 GMT+0300 (East Africa Time)
 * @package Vendor\Services\Authentication\Sessions
 * @version miracle v1.2.0
 * @abstract Session Service Provider (SSP) model. Provides 
 * service methods to allow session manipulation. 
 */

abstract class SessionServiceProvider extends SessionServiceConfiguration
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN SSP PROVIDER SERVICES 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Begin a session
     * - This method begins a new session
     * - If a session has not been established it begins a new session, otherwise, it continues with the existing session
     * @return bool|void
     */
    public function beginSession()
    {
        if (!isset($_SESSION)) {
            return session_start();
        }
        return;
    }

    /**
     * #### Destroy all set sessions
     * - This method destroys all generated session data
     * - The method checks if an existing session has already been defined
     * - If a session exists it destroys all data in the existing session
     * - If no session exists the method begins a new session and destroys all session data
     * @return bool|void
     */
    public function endSession()
    {
        $this->beginSession();
        return session_destroy();
    }


    /**
     * #### Set a new session
     * - This method Registers a session to the Session ($_SESSION) handler
     * - Registered sessions must contain a session name, session value and session type.
     * - The type and manner in which to handle the session is defined by the type argument.
     * - The default value for the type argument is  ```string```  
     * - Sessions can be assigned to a session name or appended to a session array identified by their session name
     * - Session type primitives include the following
     * 1. string - Assign a session value to the specified session name
     * 2. array - Append a session value to the specified session name array
     * @throws \Vendor\Services\Exceptions\SessionServiceExceptions
     * @return false|void
     */
    public function setSession()
    {
        if ($this->matchSessionTypes()) {
            return true;
        }
        parent::throwSessionTypeInvalidException($this->getSessionType());
        return false;
    }

    /**
     * #### Set Array session
     * - This method defines a directive for appending session values to the end of a defined session array
     * @return true
     */
    private function setArraySession()
    {
        $_SESSION[$this->getSessionName()][] = $this->getSessionValue();
        return true;
    }

    /**
     * #### Set a string session
     * - This method defines a directive for binding a session value to a session identified by the session name
     * @return true
     */
    private function setStringSession()
    {
        $_SESSION[$this->getSessionName()] = $this->getSessionValue();
        return true;
    }

    /**
     * #### Match session types
     * - This method verifies the set session type and returns the appropriate directive
     * @return void|false
     */
    private function matchSessionTypes()
    {
        return match ($this->getSessionType()) {
            "string" => $this->setStringSession(),
            "array" => $this->setArraySession(),
            "default" => false,
        };
    }

    /**
     * #### Verify session name exists
     * - This method checks if a session identified by its session name exists in the session handler
     * - The method returns true if the session exists otherwise it throws a session name not found runtime exception
     * @return bool
     * @throws \RuntimeException
     */
    public function verifySessionNameExists()
    {
        if (isset($_SESSION[$this->getSessionName()])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *  #### Destroy a session by name
     * - This method destroys a set session identified by its name.
     * - If the name of the session is invalid or does not exists, the method throws a session name not found runtime exception
     * @return bool|void
     */
    public function destroySessionByName()
    {
        if (isset($_SESSION[$this->getSessionName()])) {
            unset($_SESSION[$this->getSessionName()]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * #### Get a named session
     * - This method fetches a session by its name from the session handler.
     * - If the name of the session is invalid or does not exist, the method throws a session name not found runtime exception
     * @return bool|string|array|void
     * @throws \Vendor\Services\Exceptions\SessionServiceExceptions
     */
    public function getSessionByName()
    {
        if ($this->verifySessionNameExists()) {
            return $_SESSION[$this->getSessionName()];
        }
        return;
    }


    /**
     * #### Get all registered session names
     * - This method returns all array keys in the session handler
     * - The method checks if an active session has already been established
     * - If a session is set the method returns the session array otherwise the method throws an exception 
     * @return array|void
     * @throws \Vendor\Services\Authentication\Sessions\Models\SessionServiceExceptions::throwSessionNotStartedtException
     */
    protected function getAllRegisteredSessionNames()
    {
        if (isset($_SESSION)) {
            return array_keys($_SESSION);
        }
        parent::throwSessionNotStartedException();
        return;
    }

    /**
     * #### Get all registered sessions
     * - This method returns a verborse output of session data. 
     * - This includes session names and session values
     * - The method checks if an active session has already been established
     * - If a session is set the method returns the session array otherwise the method throws an exception 
     * @return array|void 
     * @throws \Vendor\Services\Authentication\Sessions\Models\SessionServiceExceptions::throwSessionNotStartedtException
     */
    protected function getAllRegisteredSessions()
    {
        if (isset($_SESSION)) {
            return $_SESSION;
        }
        parent::throwSessionNotStartedException();
        return;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SSP PROVIDER SERVICES 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */



    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN SSP SERVICE PRIMITIVES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     *  #### Start a session
     * @return bool|void
     * @extends parent<SessionServiceProvider::beginSession>
     */
    public static function start()
    {
        return self::boot()->beginSession();
    }

    /**
     * #### Set a session
     * @param string $name - The name of the session to be set
     * @param array|string $value - The value of the session to be set
     * @param string $type - The session type
     * @extends parent<SessionServiceProvider::setSession> 
     */
    public static function set(string $name, array|string $value, string $type = "string")
    {
        self::boot()->setSessionName($name);
        self::boot()->setSessionValue($value);
        self::boot()->setSessionType($type);
        return self::boot()->setSession();
    }

    /**
     * #### Verify session name exists
     * @param string $name - The name of the searched session
     * @return bool
     * @throws \Vendor\Services\Exceptions\SessionServiceExceptions
     * @extends parent<SessionServiceProvider::verifySessionNameExists>
     */
    public static function exists(string $name): bool
    {
        self::boot()->setSessionName($name);
        return self::boot()->verifySessionNameExists();
    }

    /**
     * #### Get a named session
     * @param string $name - The name of the fetched session
     * @return bool|string|array
     * @throws \Vendor\Services\Exceptions\SessionServiceExceptions
     * @extends parent<SessionServiceProvider::getSessionByName>
     */
    public static function get(string $name): mixed
    {
        self::boot()->setSessionName($name);
        return self::boot()->getSessionByName();
    }

    /**
     *  #### Destroy a session by name
     * @param string $name the session name
     * @return bool|void
     * @extends parent<SessionServiceProvider::destroySessionByName>
     */
    public static function destroy(string $name)
    {
        self::boot()->setSessionName($name);
        return self::boot()->destroySessionByName();
    }

    /**
     * #### End all sessions
     * @return bool|void
     * @extends parent<SessionServiceProvider::endSessions>
     */
    public static function end()
    {
        return self::boot()->endSession();
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END SSP SERVICE PRIMITIVES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
   */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN SESSION SERVICE HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Generate a token session
     * - This method registers a token to the session handler.
     * - Registered tokens must contain the following primitives:
     * 1. session-name - The name of the registered token
     * 2. session-value - The value of the registered token
     * 3. session-handler - The token handler name. token is the default handler
     * 4. session-passkey - A token fingerprint
     * @param string $tokenName - The name of set token
     * @param string $tokenValue - The value of the set token
     */
    public function generateTokenSession(string $tokenName, string $tokenValue)
    {
        $TokenSessionIdentity = [
            "session-name" => $tokenName,
            "session-value" => $tokenValue,
            "sesson-handler" => "token",
            "session-passkey" => ""
        ];
        self::set($tokenName, $TokenSessionIdentity);
        return;
    }


    /**
     * #### Get session service handlers. 
     * - This method returns all service handlers attached to a defined session.
     * - Defined sessions are identified by the following set of  primitives:
     * 1. session-name - The name of the defined session
     * 2. session-value - The value of the  defined session
     * 3. session-handler - The handler for a defined session whether a token session or normal session
     * 4. session-passkey - The fingerprint for accsessing a defined session. This key must be provided
     *                      when fetching a session variable 
     */
    public function getSessionServiceHandlers(string $name, string $handler)
    {
        self::start();
        $this->setSessionName($name);
        return match ($handler) {
            "name" => $this->getStoredSessionName(),
            "value" => $this->getStoredSessionValue(),
            "handler" => $this->getStoredSessionHandler(),
            "passkey" => $this->getStoredSessionPassKey()
        };
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END SESSION SERVICE HANDLERS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}