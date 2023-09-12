<?php

class Routes
{


    public static $instance = null;

    private string $name;

    private $callback;

    function setCallback(string $callback)
    {
        $this->callback = $callback;
    }

    public static function boot()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Routes();
        }
        return self::$instance;
    }

    function setName(string $name)
    {
        $this->name = $name;
    }

    function getCallBack()
    {
        return $this->callback;
    }

    function getName()
    {
        return $this->name;
    }

    function registerNameToRoutes(string $name)
    {
        $_SESSION["names"][] = $name;
    }

    function getNames()
    {
        return $_SESSION["names"];
    }

    public static function route($name, callable $callback)
    {
        self::boot()->setName($name);
        self::boot()->setCallback($callback);
    }
}

session_start();

Routes::route("Peter", function () {
    return "Peter Mwambi";
});

Routes::route("Caleb", function () {
    return "Caleb Mwambi";
});

echo call_user_func("Routes::route", "Peter", function () {
    return "Hello World";
});