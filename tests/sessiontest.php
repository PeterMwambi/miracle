<?php

use Core\FileAccess;
use Vendor\Services\File\Classes\FileService;

session_start();

// session_destroy();

print_r($_SESSION);

//Ensure that you destroy all sessions after client has finished with them
//Establish a session life cycle policy

// file_put_contents(FileAccess::formattedRoot() . "/tests/temp.usr", $session);\\


$path = FileService::boot()->getRootDir() . "/tests/temp.usr";

$contents = file_get_contents($path);

session_decode($contents);




// $file = fopen($path, "r");

// while (!feof($file)) {
//     echo fread($file, filesize($path));
// }

// fclose($file);