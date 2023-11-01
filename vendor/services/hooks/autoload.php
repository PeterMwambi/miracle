<?php

namespace Vendor\Services\Hooks;


use Vendor\Services\Exceptions\FileServiceExceptions as FileException;



/**
 * @author Peter Mwambi
 * @date Fri May 26 2023 14:22:28 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract Autoloads Class files via their namespaces
 */
class Autoload
{



    /*
     |`````````````````````````````````````````````````````````````````````````````````````````````````````
     |BEGIN AUTOLOAD
     |`````````````````````````````````````````````````````````````````````````````````````````````````````
     */

    /**
     * Autoload Instance Registrar
     * - This property stores an instance of the autoload object
     * @var Autoload $instance - An instance of autoload class
     */
    private static $instance = null;

    /**
     * Autoload::class object
     * This method returns an instance of Autoload::class as a factory.
     * If the autoload instance registrar has not been defined, it instantiates
     * it with an Autoload::class instance
     * @return Autoload|void
     */
    public static function start()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Autoload();
        }
        return self::$instance;
    }



    private function absolutePath()
    {
        return (strtolower(str_replace("\\", "/", dirname(__DIR__, 3))) . "/");
    }


    private function file(string $className)
    {
        return strtolower(str_replace("\\", "/", $className . ".php"));
    }
    /**
     * Autoload classes
     * This method attempts to automatically call class files from their namespaces. 
     * File names are presented in lower case as they appear in the directory list,
     * and are separated using forward slashes (/) to ensure compatibility with linux systems 
     * @return void;
     */
    public function __construct()
    {
        spl_autoload_register(
            function ($className) {
                if (file_exists($this->absolutePath() . $this->file($className))) {
                    require_once($this->absolutePath() . $this->file($className));
                } else {
                    FileException::invalidFilePathException($this->absolutePath() . $this->file($className));
                    exit;
                }
            }
        );
        return;
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END AUTOLOAD
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


}