<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record Form</title>
    <link rel="stylesheet" href="./style/index.css">
</head>
<body>

<?php 
require_once "include/constantes.php";
require_once "include/functions.php";
$isErr=false;
$action="c";

$nom = $prenom = $email = $phone = $password = $adresse = $hote ="";
$nomE = $prenomE = $emailE = $phoneE = $passwordE = $adresseE = $hoteE ="";

?>
<span class="obligatoire">champs obligatoire(*)</span>
<form action="PageServices.php?action=create" method="post" <?=novalidate?>>
<p>Piece</p>
    <p>
        <input type="text" name="Libelle" id="Libelle" placeholder="Libelle" required ><?=$nomE?><span class="champs">*</span> 
    </p>
    <input type="submit" name="Valider" value="create">
    
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