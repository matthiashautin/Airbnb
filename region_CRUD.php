<?php
// inclusion des fichiers suivant, permet de répéter des actions
// sur chaque page php
//require_once "./inc/fn/header_default.php";
require_once "./include/constantes.php";
require_once "./include/functions.php";

//require_once "./app/autoload.php";	//loading automatique des classes
require_once "./RegionBll.php";

//init variables
$p = $nom = $msgErr = "";
$nomErr = $idErr = "";
$id="";
$req="required"; 
$ro='readonly="readonly"';

if (!empty($_REQUEST["p"])) {
    $p = strtolower(test_input($_REQUEST["p"]));
}
if (!empty($_REQUEST["id"])) {
    $id = test_input($_REQUEST["id"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //rappel, la 1ere fois pas de post

    if (!empty($_POST["Nom"])) {
      $nom = test_input($_POST["Nom"]);
    }

    $regionbll = new RegionBLL();
		$reg = new Region(null, null);
    switch ($p) {
        case "update":
						if(!$reg->setNom($nom)){
							$nomErr = "";
						}
						$ret = $regionbll->Update($id, $nom);
						if (is_bool($ret) && $ret == true) {
							redirect("PageRegionObjet.php?createupdate=".$reg->Id());
							exit();
						} else {
							$nomErr = $regionbll->Error("Nom");
							$idErr = $regionbll->Error("Id");
								// foreach ($userbll->Errors() as $value) {
								// 	$msgErr .= convertChr13toBr($value);
								// }
							//	$msgErr = convertChr13toBr($userbll->Errors());
						}
            break;
        case "delete":
            $ret = $regionbll->DeletebyId($id);
            if (is_bool($ret) && $ret == true) {
								redirect("PageRegionObjet.php");
								exit();
            } else {
							foreach ($userbll->Errors() as $value) {
								$msgErr .= convertChr13toBr($value);
							}
              //$msgErr = convertChr13toBr($userbll->Errors());
            }
            break;
				default: //create
						$ret = $regionbll->Create($nom);
						if($ret)
            //if ($ret > -1) {
						if (is_numeric($ret) && $ret >-1) {
								redirect("PageRegionObjet.php?createupdate=".$ret);
								exit();
            } else {
							$nomErr = $regionbll->Error("Nom");
							// foreach ($regionbll->Errors() as $value) {
							// 	$msgErr .= convertChr13toBr($value);
							// }
              //$msgErr = convertChr13toBr($regionbll->Errors());
            }
            break;
    }
}

//SI PAS POST, donc 1ere fois
$libp = "";
switch ($p) {
    case "update":
				$libp = "Update";
				$req=""; //mdp non obligatoire
				$regionbll = new RegionBLL();
				$regions = $regionbll->listRegionbyId($id);
				if(count($regions)>0){
					$nom = $regions[0]->Nom();
					$ro="";
				}
        break;
    case "delete":
				$libp = "Delete";
				$regionbll = new RegionBLL();
				$regions = $regionbll->listRegionbyId($id);
//var_dump($users);
				if(count($regions)>0)
				{
					$id = $regions[0]->Id();
					$nom = $regions[0]->Nom();
				}
				//$usr = new User(null, $surname, $name, $mail, $passwd, null, null, false);
    		//$usr->setPassword2($passwd2);
        break;
    default:
				$p = "create";
				$libp = "Create";
				$req="";
				$ro="";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=<1.0>">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create/Update/Delete Region Page</title>
  <link rel="stylesheet" type="text/css" href="./style/style.css<?php preventCache()?>">
</head>
<body>
  <h1><?=$libp?> Region Page</h1>
  <form id="frm" <?=form_novalidate?> action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="application/x-www-form-urlencoded">
    <fieldset>
			<legend><?=$libp?> Region</legend>
			<label class="error"><?=$msgErr?></label>
			<input type="hidden" name="p" value="<?=$p?>"/><br/>
      <label for="id" title="">Id</label>
      <input tabindex="1" type="text" id="id" nom="id" placeholder="Id" <?=$req?> readonly="readonly" value="<?=($id)?>" size="5"/>
      <span><?=($idErr)?></span>
      <br/>
      <label for="Nom">Nom </label>
      <input tabindex="2" type="text" id="Nom" nom="Nom" placeholder="Nom Région" minlength="1" maxlength="50" required <?=$ro?> value="<?=($nom)?>" size="35"/>
      <span><?=($nomErr)?></span>
			<input type="submit" value="<?= $libp ?>" id="btnSend">
    </fieldset>
  </form>
</body>
</html>