<?php


namespace Vendor\Services\Tokens;

use Vendor\Services\Exceptions\TokenServiceExceptions;

/**
 * @author Peter Mwambi
 * @date Fri Jun 02 2023 13:49:23 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Authentication\Token
 * @abstract Token Service Configuration Provider(TSCP). Sets all 
 * configuration data for tokens
 */
abstract class TokenServiceConfiguration extends TokenServiceExceptions
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN TSCP SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### TSP interface registrar
     * - This property stores an instance of the TSP service interface
     * @var TokenServiceProvider
     */
    protected static $instance = null;


    /**
     * #### Token name registrar
     * - This property stores a registered token name
     * @var string - The Token name
     */
    private $tokenName;

    /**
     * #### Token registrar
     * - This property stores a generated token
     * @var string
     */
    private $token = "";

    /**
     * #### Token key registrar
     * - This property stores a registered token key
     * @var string
     */
    private $privateKey = "";

    /**
     * #### User token registrar
     * - This property stores a defined client token
     * @var string
     */
    private $userToken = "";

    /**
     * #### Known token registrar
     * - This property stores the value of a known token
     * @var string
     */
    private $knownToken = "";


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END PROPERTIES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN TSCP GETTER AND SETTER METHODS 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Set Token Name
     * - This method registers a token name to the token name registrar
     * @return void
     */
    protected function setTokenName(string $tokenName)
    {
        $this->tokenName = $tokenName;
        return;
    }

    /**
     * #### Get Token name
     * - This property gets a registered token name from the token name registrar
     */
    protected function getTokenName()
    {
        return $this->tokenName;
    }

    /**
     * #### Get Token
     * - This property gets a registered token from the token registrar 
     * @return string
     */
    protected function getToken()
    {
        return $this->token;
    }

    /**
     * #### Set Token
     * - This method registers a token to the token registrar
     * @param string $token - Token to be registered
     * @return void
     */
    protected function setToken(string $token): void
    {
        $this->token = $token;
        return;
    }

    /**
     * #### Get Private Key
     * - This method gets a registered private key
     * - Private keys are concatenated with token names and random bytes to create a strongly encrypted hash
     * @return string
     */
    protected function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * #### Set Private Key
     * - This method registers a defined private key to the token private key registrar
     * @param string $privateKey Summary of privateKey
     * @return self
     */
    protected function setPrivateKey($privateKey): self
    {
        $this->privateKey = $privateKey;
        return $this;
    }

    /**
     * #### Get User Token
     * - This method gets a defined user token from the user token registrar
     * @return string
     */
    protected function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * #### Set User Token
     * - This method registers a token to the user token registrar
     * @param string $userToken - The registering token
     * @return void
     */
    protected function setUserToken(string $userToken): void
    {
        $this->userToken = $userToken;
        return;
    }

    /**
     * #### Get Known Token
     * - This method gets a defined token from the known token registrar
     * @return string
     */
    protected function getKnownToken()
    {
        return $this->knownToken;
    }

    /**
     * #### Set Known Token
     * - This method registers a token to the known token registrar
     * @param string $tokenName Summary of tokenName
     * @return void
     */
    protected function setKnownToken(string $knownToken): void
    {
        $this->knownToken = $knownToken;
        return;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END TSCP GETTER AND SETTER METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END TSCP SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}