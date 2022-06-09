<?php
require_once "./include/dbConn.php";

  $pdoStat = $pdo->prepare('SELECT * FROM Piece WHERE id=:ID');
  $pdoStat->bindValue(':ID', $_GET['id'], PDO::PARAM_INT);
  $executeOk = $pdoStat->execute(); 
  $Client = $pdoStat->fetch();  
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

$nom = $prenom = $email = $phone = $password = $adresse = $hote ="";
$nomE = $prenomE = $emailE = $phoneE = $passwordE = $adresseE = $hoteE ="";
if((isset($_POST['Valider']))){ 
//var_dump($_POST);
    if (empty($_POST["Nom"])){
        $nomE = "*";
        $isErr=true;
    }
    else{
        $nom = test_input($_POST["Nom"]);
    }
}
?>
<span class = "champ">champ obligatoire(*)</span>
<form action="PagePiece.php?action=update" method="post">
<input type="text" name="ID" value="<?= $Client["ID"] ?>">
<p>Modif Piece</p>
    <p>
        <input type="text" name="Nom" id="Nom" placeholder="Nom" required  value="<?= $Client['Nom']; ?>" <?=$nomE?>/>
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
