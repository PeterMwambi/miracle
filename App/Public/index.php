<?php
use Models\Core\App\Routes\Shell\Api as RouteAPI;
use Models\Core\App\Utilities\Autoloader as Autoload;


if (!file_exists(dirname(__DIR__) . "\models\core\app\utilities\autoloader.php")) {
    die;
}


require_once dirname(__DIR__) . "\models\core\app\utilities\autoloader.php";

// error_reporting(0);

date_default_timezone_set("Africa/Nairobi");

$autoload = new Autoload;

$autoload->start();

RouteAPI::runService();

?>