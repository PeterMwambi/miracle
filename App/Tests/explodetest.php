<?php



//Methods validating 

$string = "DatabaseWriter/ValidateRegisterMemberUsername";

$methodBoundary = explode("/", $string);

$Keys = array_keys($methodBoundary);

$WriteNewKeys = ["class", "method"];

$Keys = array_replace($Keys, $WriteNewKeys);

$methodBoundary = ((object) array_combine($Keys, array_values($methodBoundary)));

echo "Class: " . $methodBoundary->class . " Method: " . $methodBoundary->method;