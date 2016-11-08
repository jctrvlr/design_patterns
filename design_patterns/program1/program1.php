<?php
////////////////////////////////////////
//                                    //
//  @author John Cummings             //
//                                    //
//  In this program I used a factory  //
//  in order to make the car, a       //
//  decorator in order to change the  //
//  color of the car, and a strategy  //
//  in order to choose which decorator//
//  to use in order to change to the  //
//  correct color.                    //
//                                    //
////////////////////////////////////////

// Basic car class with make, model, color
class car {
  private $make;
  private $model;
  private $color;

  function __construct($make, $model, $color) {
    $this->make = $make;
    $this->model = $model;
    $this->color = $color;
  }
  
  function getColor() {
    return $this->color;
  }

  function getMake() {
    return $this->make;
  }
  
  function getModel() {
    return $this->model;
  }

  function getMakeAndModel() {
    return $this->getMake() . ' ' . $this->getModel();
  }
}
// Car factory to more easily make cars
class carFactory {
  public static function create($make, $model, $color) {
    return new car($make, $model, $color);
  }
}
// Main decorator class
class carDecorator {
  protected $car;
  protected $color;
// Set car variable with input object and resetColor
  public function __construct(Car $car_in) {
    $this->car = $car_in;
    $this->resetColor();
  }

  function resetColor() {
    $this->color = $this->car->getColor();
  }

  function showColor() {
    return $this->color;
  }
}
// Different color specific decorators depending on color
class redCar extends carDecorator {
  private $cd;
// Call change color in construct to run automatically
  public function __construct(carDecorator $cd_in) {
    $this->cd = $cd_in;
    $this->changeColor();
  }

  function changeColor() {
    $this->cd->color = 'Red';
  }
}

class greenCar extends carDecorator {
  private $cd;

  public function __construct(carDecorator $cd_in) {
    $this->cd = $cd_in;
    $this->changeColor();
  }

  function changeColor() {
    $this->cd->color = 'Green';
  }
}

class blueCar extends carDecorator {
  private $cd;

  public function __construct(carDecorator $cd_in) {
    $this->cd = $cd_in;
    $this->changeColor();
  }

  function changeColor() {
    $this->cd->color = 'Blue';
  }

}
// Strategy which calls the different color specific decorators 
// based on what is input
class colorStrat {
  public $strategy = NULL;

  public function __construct(carDecorator $cd_in, $color) {
    switch($color) {
      case "blue":
        $this->strategy = new blueCar($cd_in);
	break;
      case "red":
        $this->strategy = new redCar($cd_in);
	break;
      case "green":
        $this->strategy = new greenCar($cd_in);
	break;
      default:
        echo "That color is not available";
    }

  }
}
// Instantiate a car and the car decorator
// Sets original color to purple
$ourCar = carFactory::create('Ford', 'Fiesta', 'purple');
$decorator = new carDecorator($ourCar);
// Get color from form and feed it into the strategy 
$color = $_POST["color"];
$paintedCar = new colorStrat($decorator, $color);

echo '<br>';
echo 'Your cars color is ' . $decorator->showColor();



?>
