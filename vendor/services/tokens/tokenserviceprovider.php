<?php

namespace Vendor\Services\Tokens;

use Vendor\Services\Sessions\Session;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Sat Jun 03 2023 21:10:39 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Authentication\Tokens
 * @abstract Token Service Provider(TSP) Models. Provides token service methods
 */
abstract class TokenServiceProvider extends TokenServiceConfiguration
{

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN TSP MODEL SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Generate Token
     * - This method generates a key hashed token using the HMAC method
     * @return void
     */
    protected function generateToken()
    {
        $this->setPrivateKey($this->getTokenName() . session_id());
        $this->setToken(hash_hmac("sha256", bin2hex(random_bytes(128)), $this->getPrivateKey()));
        $this->storeToken();
        return;
    }

    /**
     * #### Store Token
     * - This method stores a generated token to the session handler
     * @return void
     */
    protected function storeToken()
    {
        Session::boot()->generateTokenSession($this->getTokenName(), $this->getToken());
        return;
    }

    /**
     * #### Verify Token
     * - This method compares a user defined token aganist a known token identified by its token name
     * - If the user token matches the stored token, the method returns `true` otherwise the method returns `false`
     * @return bool
     */
    protected function verifyToken()
    {
        if (hash_equals($this->getKnownToken(), $this->getUserToken())) {
            return true;
        } else {
            return false;
        }
    }
    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END TSP MODEL SERVICES
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */
}