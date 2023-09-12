<?php


//Factory Service Provider
class Factory
{

  private static $instance = null;


  private static function createInstance(object $instance)
  {
    if (!isset(self::$instance)) {
      self::$instance = new $instance;
    }
    return self::$instance;
  }

  private static function reset()
  {
    if (isset(self::$instance)):
      return clone self::$instance;
    endif;
  }

  public static function boot(object $instance)
  {
    self::reset();
    return self::createInstance($instance);
  }

  public function __clone()
  {
    self::$instance = null;
  }

}

class User extends Factory
{

  static function instance()
  {
    return parent::boot(new User());
  }

  function name()
  {
    return "Peter Mwambi";
  }
}

class Auth extends Factory
{
  static function instance()
  {
    return parent::boot(new Auth());
  }

  //verify username
  function username()
  {
    return "pmwambi";
  }
}


echo Auth::instance()->username();

echo User::instance()->name();
?>