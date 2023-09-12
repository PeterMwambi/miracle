<?php

namespace Vendor\Services\Headers;


use Vendor\Services\Headers\HeaderServiceProvider;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Jun 15 2023 18:32:46 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Headers
 * @abstract Header Service Provider (HSP) Interface
 * Provides an interface to access header services
 */
class Header extends HeaderServiceProvider
{

    public static function registerAsset(string $fileExtension)
    {
        return self::boot()->registerAssetMimeType($fileExtension);
    }

    public static function redirect(string $url)
    {
        return self::boot()->setRedirectURL($url);
    }

    public function __destruct()
    {
        self::resetInstance();
        return;
    }
}