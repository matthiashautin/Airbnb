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

        $publication = $prixht = $adresse="";
        $publicationE = $prixhtE = $adresseE="";

?>
<span class="obligatoire">champs obligatoire(*)</span>
<form action="PageAnnonce.php?action=create" method="post" <?=novalidate?>>
<p>Client</p>
    <p>
        <input type="text" name="Publication" id="Publication" placeholder="Publication" required ><?=$publicationE?><span class="champs">*</span> 
    </p>
    <p>
        <input type="text" name="PrixHT" id="PrixHT" placeholder="PrixHT" required><?=$prixhtE?><span class="champs">*</span> 
    </p>
    <p>
        <input type="Adresse" name="Adresse" id="Adresse" placeholder="Adresse" required><?=$adresseE?><span class="champs">*</span>
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