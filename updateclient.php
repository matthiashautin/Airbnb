<?php
require_once "./include/dbConn.php";

  $pdoStat = $pdo->prepare('SELECT * FROM Client WHERE id=:ID');
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

    if (empty($_POST["Prenom"])){
        $prenomE = "*";
        $isErr=true;
    }
    else{
        $prenom = test_input($_POST["Prenom"]);
    }

    if (empty($_POST["Email"])){
        $emailE = "*";
        $isErr=true;
    }
    else{
        $email = test_input($_POST["Email"]);
    }

    if (empty($_POST["Phone"])){
        $phoneE = "*";
        $isErr=true;
    }
    else{
        $phone = test_input($_POST["Phone"]);
    }
    if (empty($_POST["Passwords"])){
        $passwordE = "*";
        $isErr=true;
    }
    else{
        $password = test_input($_POST["Passwords"]);
    }
}
?>
<span class = "champ">champ obligatoire(*)</span>
<form action="PageClient.php?action=update" method="post">
<input type="text" name="ID" value="<?= $Client["ID"] ?>">
<p>Modif Client</p>
    <p>
        <input type="text" name="Nom" id="Nom" placeholder="Nom" required  value="<?= $Client['Nom']; ?>" <?=$nomE?>/>
    </p>
    <p>
        <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" required  value="<?= $Client['Prenom']; ?>" <?=$prenomE?>/>
    </p>
    <p>
        <input type="email" name="Email" id="Email" placeholder="Email" required  value="<?= $Client['Email']; ?>" <?=$emailE?>/>
    </p>
    <p>
        <input type="text" name="Phone" id="Phone" placeholder="Phone" required maxlenght="10" pattern="[0-9]+" value="<?= $Client['Phone']; ?>"  <?=$phoneE?>/>
    </p>
    <p>
        <input type="Password" name="Passwords" id="Passwords" placeholder="Password" required value="<?= $Client['Passwords']; ?>" <?=$passwordE?>/>
    </p>
    <p>
        <input type="text" name="Adresse" id="Adresse" placeholder="Adresse" value="<?= $Client['Adresse']; ?>" />
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
