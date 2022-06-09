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
<form action="PageClient.php?action=create" method="post" <?=novalidate?>>
<p>Client</p>
    <p>
        <input type="text" name="Nom" id="Nom" placeholder="Nom" required ><?=$nomE?><span class="champs">*</span> 
    </p>
    <p>
        <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" required><?=$prenomE?><span class="champs">*</span> 
    </p>
    <p>
        <input type="email" name="Email" id="Email" placeholder="Email" required><?=$emailE?><span class="champs">*</span> 
    <p>
        <input type="text" name="Phone" id="Phone" placeholder="Phone" required="required" require maxlenght="10" pattern="[0-9]+"> <?=$phoneE?><span class="champs">*</span>
    </p>
    <p>
        <input type="Password" name="Passwords" id="Passwords" placeholder="Password" required><?=$passwordE?><span class="champs">*</span>
    <p>
        <input type="text" name="Adresse" id="Adresse" placeholder="Adresse" >
    </p>
    <p>
        <label for="Hote">Hote:</label>
        <input type="checkbox" name="Hote" id="Hote" placeholder="Hote" VALUE="1" value="0"><?=$hoteE?>
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