<?php
/////////////////////////////////
// Author: John Cummings       //
// Combination of prototype,   //
// factory, and strategy which //
// allows the user to "checkin"//
// which subtracts fuel from   //
// the reserves and increases  //
// the location.               //
/////////////////////////////////

// This is the abstract of the prototype
abstract class vehicle {
  protected $fuel;
  protected $location;

  protected $type;

  public function __construct() {}

  abstract function __clone();
  
  public function getFuel() {
    return $this->fuel;
  }
  
  public function checkIn() {}

}
// The airplane prototype
class airplane extends vehicle {

  public function __construct() {
    $this->fuel = 100;
    $this->location = 1;
    $this->type = 'airplane';
  }

  function __clone() {}

  public function checkIn() {
    $oldFuel = $this->fuel;
    $this->fuel = $this->fuel - 1;
    $oldLocation = $this->location;
    $this->location = $this->location + 10;

    return 'There is ' . $this->fuel . ' units of fuel left. Our location has changed
    from ' . $oldLocation . ' to ' . $this->location . '.';
  }
} 
// The car prototype
class car extends vehicle {
  public function __construct() {
    $this->fuel = 10;
    $this->location = 1;
    $this->type = 'car';
  }

  function __clone() {}

  public function checkIn() {
    $oldFuel = $this->fuel;
    $this->fuel = $this->fuel - 1;
    $oldLocation = $this->location;
    $this->location = $this->location +1;

    return 'There is ' . $this->fuel . ' units of fuel left. Our location has changed
    from ' . $oldLocation . ' to ' . $this->location . '.';
  }
}
// This is the factory which creates clones of the 
// prototypes which were shown in the classes above.
// We must first instantiate the prototypes and
// feed them into the factory functions for it to
// work though.
class vehicleFactory {
  protected $airplaneProto;
  protected $carProto;

  public function __construct() {}

  public static function createAirplane(airplane $airplaneProto) {
    return clone $airplaneProto;
  }
  public static function createCar(car $carProto) {
    return clone $carProto;
  }
}
// Instantiate the prototypes
$airplaneProto = new airplane();
$carProto = new car();
// Create the plane and car objects using the vehicleFactory
$plane = vehicleFactory::createAirplane($airplaneProto);
$car = vehicleFactory::createCar($carProto);
// Call the checkIn() function which changes
// the fuel and location variables of the
// object.
$plane->checkIn();
$plane->checkIn();
$plane->checkIn();
$plane->checkIn();

echo 'Plane after 5 checkins';
echo '<br>';
echo $plane->checkIn();
echo '<br>';
echo '<br>';
// Call the checkIn() function which changes
// the fuel and location variables of the 
// object. Notice car starts with less fuel
// and travels a smaller distance than the airplane.
$car->checkIn();
$car->checkIn();
$car->checkIn();
$car->checkIn();

echo 'Car after 5 checkins';
echo '<br>';
echo $car->checkIn();
echo '<br>';
echo '<br>';
