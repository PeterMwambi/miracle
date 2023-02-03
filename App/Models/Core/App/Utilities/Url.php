<?php
namespace Models\Core\App\Utilities;

use Models\Core\App\Routes\Kernel\Config as RoutePrefixConfig;
use Exception;


/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @package Utilities
 * @date Tue Jan 18 2022 09:14:17 GMT+0300 (East Africa Time)
 * @updated Sat Dec 03 2022 14:47:35 GMT+0300 (East Africa Time)
 * @content Output stream
 */

class Url
{


    public static function GetPath(string $filePath)
    {
        $directories = array("../../", "../", "../../../../", "./");
        foreach ($directories as $directory) {
            if (file_exists($directory . $filePath)) {
                return $directory . $filePath;
            } else {
                throw new Exception("Warning: requestd file: " . $filePath . "Was not found");
            }
        }
    }

    public static function GetReference(string $filepath)
    {
        $routeprefix = new RoutePrefixConfig;
        return $routeprefix->GetRoutePrefix() . $filepath;
    }
}