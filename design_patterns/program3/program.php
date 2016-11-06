<?php


class responseStrat {
  public $strategy = NULL;

  public function __construct($message) {
    switch($message) {
      case "hello":
        $this->strategy = new responseFactory("hello");
	break;
      case "whoami":
        $this->strategy = new responseFactory("whoami");
	break;
      case "owner":
        $this->strategy = new responseFactory("owner");
	break;
      default:
        echo "That is not a valid message";
    }
  }
  public function getResponse() {
    return $this->strategy->getResponse();
  }
}

abstract class AbstractFactoryMethod {
  abstract function __construct($param);
}

class responseFactory extends AbstractFactoryMethod {
  public $response;
  public function __construct($param){
    switch($param) {
      case "hello":
        $this->response = "Hello.";
	break;
      case "whoami":
        $this->response = "I am John's creation.";
	break;
      case "owner":
        $this->response = "John is my owner/creator.";
	break;
    }
  }
  public function getResponse() {
    return $this->response;
  }
}
class responseDecorator {
  protected $response;

  public function __construct($response_in) {
    $this->response = $response_in;
  }
  function randResponse() {
    $num = rand(1, 3);
    switch($num) {
      case "1": 
        $this->response = $this->response . ' How are you today?';
	break;
      case "2":
        $this->response = $this->response . ' How are you?';
	break;
      case "3":
        $this->response = $this->response . ' How can I help you?';
	break;

    }
    return $this->response;
  }
}

$message = $_POST['message'];
$response = new responseStrat($message);
$responseText = $response->getResponse($message);

$decorator = new responseDecorator($responseText);
echo $decorator->randResponse();
?>
