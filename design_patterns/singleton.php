<?php
class Singleton {
  private static $instance;

  public static function getInstance() {
    if (null === static::$instance) {
      static::$instance = new static();
    }
    return static::$instance;
  }
  protected function __construct() {
    
  }

  private function __clone() {

  }

  private function __wakeup() {

  }
}
class SingletonChild extends Singleton {

}

$obj = Singleton::getInstance();
var_dump($obj === Singleton::getInstance());

$anotherObj = SingletonChild::getInstance();
var_dump($anotherObj === Singleton::getInstance());
var_dump($anotehrObj === SingletonChild::getInstance());
?>
