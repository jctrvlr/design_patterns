<?php
include 'observer.php';
// Create singleton class named user 
class user {
  // Only 1 instance
  private static $instance = NULL;
  private static $isLoggedIn = FALSE;
  private static $username;
  // Logs in if $isLoggedIn is false and
  // changes it to TRUE. Also returns the instance
  public static function login() {
    if(FALSE == self::$isLoggedIn) {
      if(NULL == self::$instance) {
        self::$instance = new user();
      }
      self::$isLoggedIn = TRUE;
      return self::$instance;
    } else {
      return NULL;
    }
  }
  // Logs out user by changing $isLoggedIN to false
  public function logout(user $user) {
    self::$isLoggedIn = FALSE;
  }
  // Lets you get Username
  public function getUsername() {
    return $this->username;
  }
  // Lets you set the username when you login
  public function setUsername($username) {
    $this->username = $username;
  }
  protected function __construct() {}
  private function __clone() {}
  private function __wakeup() {}

}

class userSubject {
  // $user is the user object
  private $user;
  private $loggedin = FALSE;
  // Empty Construct so can only make 1
  function __construct() {}
  // Retrieves the username that is placed when
  // the user logs in and returns not logged in if
  // the user isn't logged in.
  function getUsername() {
    if(TRUE == $this->loggedin) {
      return $this->user->getUsername();
    } else {
      return "I am not logged in";
    }
  }
  // Logs in the user by setting logged in variable 
  // as well as sets the username
  function login($username) {
    $this->user = user::login();
    if($this->user == NULL) {
      $this->loggedin = FALSE;
    } else {
      $this->loggedin = TRUE;
      $this->user->setUsername($username);
    }
  }
  // Logs the user out
  function logout() {
    $this->user->logout($this->user);
  }
}
// Instantiate the observer and
// attach the observer to subject
$observer = new PatternObserver();
$subject = new PatternSubject();
$subject->attach($observer);
// Instantiate the users
$user1 = new userSubject();
$user2 = new userSubject();

$user1->login('User1');
echo 'User 1 has tried to log in';
echo BR;
$username = $user1->getUsername();
$subject->updateFavorites($username);
echo BR;
echo BR;

$user2->login('User2');
echo 'User 2 has tried to login';
echo BR;
$username = $user2->getUsername();
$subject->updateFavorites($username);
echo BR;
echo BR;

$user1->logout();
echo 'User 1 has logged out';
echo BR;
echo BR;

$user2->login('User2');
echo 'User 2 has tried to login';
echo BR;
$username = $user2->getUsername();
$subject->updateFavorites($username);
echo BR;
echo BR;

?>
