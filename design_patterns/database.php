<?php

class db {
  private $host='sql1.njit.edu';
  private $dbname='jic6';
  private $user='jic6';
  private $pass='gz8G5NhDp';
  private static $dbh = NULL;
  private static $connected = FALSE;

  private function __construct() {}

  static function getConnection() {
      if (FALSE == self::$connected) {
        if(NULL == self::$dbh) {
          try {
	    self::$dbh = new PDO("mysql:host=$host;dbname=$dbname, $user, $pass");
	  } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
	    die();
	  }
	}
	self::$connected = TRUE;
	return self::$dbh;
      } else {
        return NULL;
      }

  }
}
$dbh = db::getConnection();
foreach($dbh->query('SELECT * from states') as $row) {
  print_r($row);
}

?>
