<?php

use Vendor\Services\File\Classes\FileService;

echo file_get_contents(dirname(__DIR__, 1) . "\.htaccess");



$file = fopen(dirname(__DIR__, 1) . "\.htaccess", "a");


$data = "Options - Indexes";
fwrite($file, $data);
fclose($file);









$file = fopen(dirname(__DIR__, 1) . "\\report.pdf", "a");
$data = "
    Fullname:Peter Mwambi
    Date:Friday, 30/6/2023
    Amount:4500ksh
    Transaction Id:QWDFH563TB
    Payment mode: Mpesa
    Narrator: Westprime Properties
    Account Number: 456RFHG67845PDGFA
";
fwrite($file, $data);
fclose($file);