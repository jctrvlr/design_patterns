<?php
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

class carFactory {
  public static function create($make, $model, $color) {
    return new car($make, $model, $color);
  }
}

class carDecorator {
  protected $car;
  protected $color;

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

class redCar extends carDecorator {
  private $cd;

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
    }

  }
}

$ourCar = carFactory::create('Ford', 'Fiesta', 'Green');
$decorator = new carDecorator($ourCar);
$paintedCar = new colorStrat($decorator, 'red');

echo $decorator->showColor();



?>
