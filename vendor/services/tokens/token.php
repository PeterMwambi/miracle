<?php

namespace Vendor\Services\Tokens;


use Vendor\Services\Tokens\TokenServiceProvider;



/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Fri Jun 02 2023 14:00:14 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Authentication\Token
 * @abstract Token Service Provider (TSP) Interface. 
 * Provides an interface to access Token Provider Services
 */
final class Token extends TokenServiceProvider
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN TSP INTERFACE SERVICE 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN BOOT TSP
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /**
     * #### Boot TSP Interface
     * - This method Registers an instance of TSP interface to the TSP service registrar
     */
    public static function boot()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Token;
        }
        return self::$instance;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END BOOT TSP
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN TSP INTERFACE METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Generate  token from token name
     * - This method generates a 128 bit wide token from a user supplied string
     * - The token is generated using sha256 encryption algorithm and a 128 random byte string for more robust security
     * @param string $tokenName - the token name
     * @return string - The generated token 
     */
    public static function generate(string $tokenName)
    {
        self::boot()->setTokenName($tokenName);
        self::boot()->generateToken();
        return self::boot()->getToken();
    }

    /**
     * #### Verify Token
     * - This method gets a client supplied token and attempts to verify it with an existing token 
     * - The existing token is stored in a session that matches the token name
     * @return bool 
     */
    public static function verify(string $userToken, string $knownToken)
    {
        self::boot()->setUserToken($userToken);
        self::boot()->setKnownToken($knownToken);
        if (self::boot()->verifyToken()) {
            return true;
        }
        parent::throwNewTokenVerificationFailed();
        return false;
    }
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END TSP INTERFACE METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END TSP INTERFACE SERVICE 
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}