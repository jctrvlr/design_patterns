<?php

class employee {
  private $id;
  private $first_name;
  private $last_name;
  public $clocked_in = FALSE;
  public $time_in;
  public $time_out;

  public function __construct($id, $f_name, $l_name) {
    $this->id = $id;
    $this->first_name = $f_name;
    $this->last_name = $l_name;
  }
  
  public function get_ID() {
    return $this->id;

  }
  
  public function get_name() {
    return $this->last_name . ', ' . $this->first_name;
  }

}

class employeeFactory {
  public static function create($id, $f_name, $l_name) {
    return new employee($id, $f_name, $l_name);
  }
}

class employeeDecorator {
  protected $employee;

  public function __construct(employee $employee_in) {
    $this->employee = $employee_in;
  }

  public function clock_in() {
    if($this->employee->clocked_in == TRUE) {
      echo 'Error: You are already clocked in!';
    } else {
      $this->employee->clocked_in = TRUE;
      $this->employee->time_in = date('Y-m-d H:i:s'); 
      echo 'Clocked in at ' . $this->employee->time_in;
    }
  }
  
  public function clock_out() {
    if($this->employee->clocked_in == FALSE) {
      echo 'Error: You are not clocked in!';
    } else {
      $this->employee->clocked_in = FALSE;
      $this->employee->time_out = date('Y-m-d H:i:s');
      echo 'Clocked out at ' . $this->employee->time_out;
    }
  }  
}

class employeeStrategy {
  public $strategy = NULL;

  public function __construct(employeeDecorator $dec_in, $command) {
    switch($command) {
      case "clockin":
        $this->strategy = $dec_in->clock_in();
        break;
      case "clockout":
        $this->strategy = $dec_in->clock_out();
        break;
    }
  }
}

$employee = employeeFactory::create('1', 'John', 'Cummings');
$decorator =  new employeeDecorator($employee);

$status = new employeeStrategy($decorator, 'clockin');
echo '<br>';
$status = new employeeStrategy($decorator, 'clockin');
echo '<br>';
$status = new employeeStrategy($decorator, 'clockout');
echo '<br>';
$status = new employeeStrategy($decorator, 'clockout');


?>
