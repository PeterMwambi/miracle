<?php

use Vendor\Services\Data\Data;
use Vendor\Services\Error\Error;

require_once str_replace("\\", "/", dirname(__DIR__)) . "/miracle/app/boot/services.php";

autoload();

Data::factory(Error::class)->reportErrors();

require_once("app/views/pages/home.php");