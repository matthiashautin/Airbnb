<?php
require_once "./include/dbConn.php";
try 
{
  $db = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_pass);

}   catch (PDOException $e) {
print "Erreur :" . $e->getMessage() . "<br/>";
die;
}
?>
