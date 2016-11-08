
<?php
$user = 'jic6';
$pass = 'gz8G5NhDp';
try {
   $dbh = new PDO('mysql:host=sql1.njit.edu;dbname=jic6', $user, $pass);
   foreach($dbh->query('SELECT * from states') as $row) {
       print_r($row);
   }
   $dbh = null;
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}
?>