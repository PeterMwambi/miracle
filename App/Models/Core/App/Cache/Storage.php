<?php


namespace Models\Core\App\Cache;

use Models\Core\App\Utilities\Session;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Mon Jan 09 2023 17:25:46 GMT+0300 (East Africa Time)
 * @updated Mon Jan 09 2023 17:25:46 GMT+0300 (East Africa Time)
 * 
 * @content - 
 */

class Storage
{

    public static function StoreToCache(array $data)
    {
        Session::Start();
        Session::Set("CACHE_DATA", $data, "array");
        return;
    }


    public static function GetCachedData()
    {
        return Session::Get("CACHE_DATA");
    }

    public static function ClearCacheData()
    {
        Session::Start();
        if (Session::Exists("CACHE_DATA")) {
            Session::Destroy("CACHE_DATA");
        }
        Session::End();
        return;
    }
}