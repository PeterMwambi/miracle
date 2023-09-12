<?php

use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Data\Data;

use Vendor\Services\Headers\Header;
use Vendor\Services\Server\Server;
use Vendor\Services\Sessions\Session;



echo Data::Factory(Server::class)::get("request/uri");



// $instance = "instance";

// $instances = [];



// for ($x = 0; $x <= 5; $x++) {
//     array_push($instances, $instance . uniqid());
// }


// class Factory_V1_0_0
// {

//     private static $instance = null;


//     private static $instances = [];

//     public static function run(string $class)
//     {
//         return self::registerClassToInstanceRegistrar($class);
//     }


//     public static function resetInstance()
//     {
//         self::$instance = null;
//         return;
//     }

//     public static function generateNewInstance(string $class)
//     {
//         if (!isset(self::$instance)) {
//             if (Data::classExists($class)) {
//                 self::$instance = new $class();
//             }
//         }
//         return self::$instance;
//     }

//     public static function getInstances()
//     {
//         return self::$instances;
//     }

//     public static function registerClassToInstanceRegistrar($class)
//     {
//         array_push(self::$instances, $class);
//         for ($x = 0; $x < count(self::$instances); $x++) {
//             if ($class === self::$instances[$x]) {
//                 self::resetInstance();
//                 return self::generateNewInstance($class);
//             }
//         }
//         return;
//     }
// }



// //This version is more error prone compared to version 1.0.0
// class Factory
// {

//     private string $class = "";

//     private array $instances = [];

//     private $instance = null;

//     private array $params = [];



//     protected function setClass(string $class)
//     {
//         $this->class = $class;
//         return;
//     }

//     protected function getClass()
//     {
//         return $this->class;
//     }

//     protected function setParams(array $params){
//         $this->params = $params;
//         return;
//     }

//     protected function getParams(){
//         return $this->params;
//     }


//     protected function setInstances(string $instances)
//     {
//         $this->instances[] = $instances;
//         return;
//     }

//     protected function getInstances()
//     {
//         return $this->instances;
//     }

//     protected function setInstance(string $instance)
//     {
//         if (!isset($this->instance)) {
//             $this->instance = new $instance();
//         }
//         return;
//     }

//     protected function getInstance()
//     {
//         return $this->instance;
//     }

//     protected function resetInstance()
//     {
//         $this->instance = null;
//         return;
//     }

//     protected function registerClassToInstance()
//     {
//         if (Data::classExists($this->getClass())) {
//             $this->resetInstance();
//             $this->setInstance($this->getClass());
//             return $this->getInstance();
//         }
//         return;
//     }

//     public function generateNewInstance(string $class)
//     {
//         $this->setClass($class);
//         $this->setInstances($this->getClass());
//         for ($x = 0; $x < count($this->getInstances()); $x++) {
//             if ($this->getClass() === $this->getInstances()[$x]) {
//                 return $this->registerClassToInstance();
//             }
//         }
//         return;
//     }


//     public static function run(string $class)
//     {
//         return (new Factory())->generateNewInstance($class);
//     }

// }