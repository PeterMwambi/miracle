<?php

$file = file_get_contents(str_replace("\\", "/", dirname(__DIR__)) . "/app/logs/requests/successful.log");

$fileArray = explode("\n", $file);

$fileContents = [];
foreach ($fileArray as $fileItems) {
    $fileItem = explode(":", $fileItems);
    array_push($fileContents, $fileItem);
}

echo "<pre>";
print_r($fileContents);
echo "</pre>";