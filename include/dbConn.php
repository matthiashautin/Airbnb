<?php
$db_servername = "mysql-hautin.alwaysdata.net";
$db_username = "hautin_location";
$db_pass = "administrateur";
$db_name = "hautin_location";
try 
{
  $pdo = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   
catch (PDOException $e) {
    print "Erreur :" . $e->getMessage() . "<br/>";  
    die;
}
?>
