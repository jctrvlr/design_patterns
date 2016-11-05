<?php
$string = "";

class StrategyContext {
  private $strategy = NULL;

  public function __construct($strategy_ind_id, $make, $model) {
    switch ($strategy_ind_id) {
      case "A":
        $this->strategy = new transFactory("C", $make, $model);
	break;
      case "B":
        $this->strategy = new transFactory("T", $make, $model);
	break;
      case "C":
        $this->strategy = new transFactory("M", $make, $model);
	break;
    }
  }
  public function getType() {
    return $this->strategy->getType(); 
  }
  public function getMake() {
    return $this->strategy->getMake();
  }
  public function getModel() {
    return $this->strategy->getModel();
  }
}

abstract class vehicle {
  private $make;
  private $model;
  private $type = NULL;

  function __construct($make, $model) {
    $this->make = $make;
    $this->model = $model;
  }
  public function getMake() {
    return $this->make;
  }

  public function getModel() {
    return $this->model;
  }
  public function getType() {
    return $this->type;
  }
}

class car extends vehicle {
  private $type = 'car'; 
}

class truck extends vehicle {
  private $type = 'truck';
}

class motorcycle extends vehicle {
  private $type = 'motorcycle';
}

abstract class AbstractFactoryMethod {
  abstract function __construct($type, $make, $model);

}

class transFactory extends AbstractFactoryMethod {
  private $context = "Vehicle";
  public $transtype = NULL;
  function __construct($type, $make, $model) {
    switch ($type) {
      case "C":
        $transtype = new car($make, $model);
	break;
      case "T":
        $transtype = new truck($make, $model);
	break;
      case "M":
        $transtype = new motorcycle($make, $model);
	break;
    }
    return $transtype;
  }
  function getMake() {
    return $this->transtype->getMake();
  }
  function getModel() {
    return $this->transtype->getModel();
  }
  function getType() {
    return $this->transtype->getType();
  }
}

define('BR', '<'.'BR'.'>');
$car = new car('Ford', 'Fiesta');

echo 'Begin strategy';
echo BR;

$strategyContextCar = new StrategyContext('A', 'Ford', 'Fiesta');
$strategyContextTruck = new StrategyContext('B', 'Ford', 'F150');
$strategyContextMotorcycle = new StrategyContext('C', 'Kawasaki', 'KLR650');

echo 'Test 1 - Set car'.BR;
echo $strategyContextCar->getType();
echo BR.BR;

?>
