<?php
require_once "./include/dbConn.php";

  $pdoStat = $pdo->prepare('SELECT * FROM Annonce WHERE id=:ID');
  $pdoStat->bindValue(':ID', $_GET['id'], PDO::PARAM_INT);
  $executeOk = $pdoStat->execute(); 
  $Annonce = $pdoStat->fetch();  
  //var_dump($Client);

  /*if($executeOk){
    $message = 'Le Client a été suprimé';
  }
  else{
    $message = 'Echec de la suppression du Client';
  }*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/index.css">
  <title>Form Modif</title>
</head>
<body>
<?php 
require_once "include/constantes.php";
require_once "include/functions.php";
$isErr=false;
$action="c";

$publication = $prixht = $adresse="";
$publicationE = $prixhtE = $adresseE="";
            if((isset($_POST['Valider']))){
    //var_dump($_POST);
                if (empty($_POST["Publication"])){
                    $publicationE = "*";
                    $isErr=true;
                }
                else{
                    $publication = test_input($_POST["Publication"]);
                }
            
                if (empty($_POST["PrixHT"])){
                    $prixhtE = "*";
                    $isErr=true;
                }
                else{
                    $prixht = test_input($_POST["PrixHT"]);
                }
            
                if (empty($_POST["Adresse"])){
                    $adresseE = "*";
                    $isErr=true;
                }
                else{
                    $adresse = test_input($_POST["Adresse"]);
                }
            }
?>
<span class = "champ">champ obligatoire(*)</span>
<form action="PageAnnonce.php?action=update" method="post">
<input type="text" name="ID" value="<?= $Annonce["ID"] ?>">
<p>Modif Annonce</p>
    <p>
        <input type="text" name="Publication" id="Publication" placeholder="Publication" required ><?=$publicationE?><span class="champs">*</span> 
    </p>
    <p>
        <input type="text" name="PrixHT" id="PrixHT" placeholder="PrixHT" required><?=$prixhtE?><span class="champs">*</span> 
    </p>
    <p>
        <input type="Adresse" name="Adresse" id="Adresse" placeholder="Adresse" required><?=$adresseE?><span class="champs">*</span>
    </p> 
<input type="submit" name="Valider" value="Enregistrer les modifications">


    <div class="container">
            <a href= "https://www.instagram.com/matthias_htn/?hl=fr" target="_blank"> matthias_htn
            <div class="instagram">
                <img src="https://img.icons8.com/color/48/000000/instagram-new--v2.png"/></a>
            </div>
        
    <div class="drop drop-1"></div>
    <div class="drop drop-2"></div>
    <div class="drop drop-3"></div>
    <div class="drop drop-4"></div>
    <div class="drop drop-5"></div>
    <div class="drop drop-6"></div>
    </div>
</form>
</body>
</html>
