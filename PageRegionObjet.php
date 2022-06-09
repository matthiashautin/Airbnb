<?php
// inclusion des fichiers suivant, permet de répéter des actions
// sur chaque page php
//require_once "./inc/fn/header_default.php";	//HEADER HTTP
require_once "./include/constantes.php";					//CONSTANTS APP
require_once "./include/functions.php";	

//init variables
$id = $nom = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=<1.0>">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>List Page</title>
  <link rel="stylesheet" type="text/css" href="./style/style.css<?php preventCache()?>">
</head>

<body>
  <h1>List Page</h1>
  <a href="region_CRUD.php?p=create"><button type="button" class="button button1">Create New Region</button></a>
  <table>
    <!-- <caption>Users List</caption> -->
    <tr>
      <th>Id</th>
      <th>Nom</th>
    </tr>
    <?php
//couche metier
//require_once "./app/autoload_inc.php";  //TODO
//Autoloader::register();

//require_once "./app/autoload.php";  //loading automatique des classes
require_once "./RegionBll.php";

$regionbll = new RegionBLL();
$regions = $regionbll->listRegions();
var_dump($regions);
foreach ($regions as $reg) {
    if(isset($_REQUEST["createupdate"])){
      if($reg->Id()==$_REQUEST["createupdate"]){
        echo "<tr class='createupdate'>";
      }
    }
    else{
      echo "<tr>";
    }
    echo "<td>" . $reg->Id() . "</td>";
    echo "<td>" . $reg->Nom() . "</td>";
    echo "<td><a href=\"region_CRUD.php?p=update&id=" . $reg->Id() . "\"><button type=\"button\" class=\"button button2\">Update</button></a></td>";
    echo "<td><a href=\"region_CRUD.php?p=delete&id=" . $reg->Id() . "\"><button type=\"button\" class=\"button button3\">Delete</button></a></td>";
    echo "</tr>";
}
?>
  </table>
  <br/>
</body>
</html>