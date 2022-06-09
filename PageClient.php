<?php
    $message ="";
//DELETE
    if((isset($_GET['action']) && $_GET['action']=="delete")){
//Il faut faire pour quand delete a PageClient
    
        require_once "./include/dbConn.php";
    
        $pdoStat = $pdo->prepare('DELETE FROM Client WHERE id=:ID');
        $pdoStat->bindValue(':ID', $_GET['id'], PDO::PARAM_INT);
        $executeOk = $pdoStat->execute();
    
        if($executeOk){
           $message = 'Le Client a été suprimé ✅';
        }
        else{
            $message = 'Echec de la suppression du Client ❌';
        }
//echo($message);
    }
//UPDATE
    if((isset($_GET['action']) && $_GET['action']=="update")){
        require_once "./include/dbConn.php";
        $pdoStat = $pdo->prepare('UPDATE Client set Nom=:Nom, Prenom=:Prenom, Email=:Email, Phone=:Phone, Passwords=:Passwords, Adresse=:Adresse WHERE id=:ID');
        
        $pdoStat->bindValue(':ID', $_POST['ID'], PDO::PARAM_INT);
        $pdoStat->bindValue(':Nom', $_POST['Nom'], PDO::PARAM_STR);
        $pdoStat->bindValue(':Prenom', $_POST['Prenom'], PDO::PARAM_STR);
        $pdoStat->bindValue(':Email', $_POST['Email'], PDO::PARAM_STR);
        $pdoStat->bindValue(':Phone', $_POST['Phone'], PDO::PARAM_STR);
        $pdoStat->bindValue(':Passwords', $_POST['Passwords'], PDO::PARAM_STR);
        $pdoStat->bindValue(':Adresse', $_POST['Adresse'], PDO::PARAM_STR);
        
        $executeOk = $pdoStat->execute();
//var_dump($executeOk);
        if($executeOk){
            $message = 'Le Client a été mis à jour ✅';
        }
        else{
            $message = 'Echec de la mise à jour du Client ❌';
        }
    }
//CREATE
    if((isset($_GET['action']) && $_GET['action']=="create")){
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
        
            if (empty($_POST["Adresse"])){
                $adresseE = "*";
                $isErr=true;
            }
            else{
                $adresse = test_input($_POST["Adresse"]);
            }
        
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            $pdo=null;
            $password=md5($_POST['Passwords']);

        require_once "./include/dbConn.php";    
            try{
                $sql = "INSERT INTO Client (ID, Nom, Prenom, Email,Phone, Passwords, Adresse, Hote, DateCreation, 
                DateModification) VALUES
                (:ID, :Nom, :Prenom, :Email, :Phone, :Passwords, :Adresse, :Hote, :DateCreation, :DateModification)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':ID', $id);
                $stmt->bindParam(':Nom', $nom);
                $stmt->bindParam(':Prenom', $prenom);
                $stmt->bindParam(':Email', $email);
                $stmt->bindParam(':Phone', $phone);
                $stmt->bindParam(':Passwords', $password);
                $stmt->bindParam(':Adresse', $adresse);
                $stmt->bindParam(':Hote', $hote);
                $stmt->bindParam(':DateCreation', $date);
                $stmt->bindParam(':DateModification', $date);

                $stmt->execute();
                echo "Le Client à bien été Créé ✅";
            } catch(PDOException $e){
                die("ERROR: Could not able to execute $sql. " . $e->getMessage());
            }
        }
    }
//echo($message);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>PageClient</title>
</head>
<body>
    <?php
        include "./include/connect.php";
        include "./Header.php";
        include "./include/menu.php";
        include "./include/link.php";
    ?>
    <section id= "main">
    <?php
        if($message!=""){
            echo "<p>$message</p>";
        }
    ?>
    <h1>Table Client</h1>
        <table class="tableau-style">
        <a href="https://hautin.alwaysdata.net/Airbnb/newclient.php" class="NouveauClient">🆕 New Client 🆕</a>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>Adresse</th>
                <th>Hote</th>
                <th>Datecreation</th>
                <th>DateModification</th>
                <th>Action</th>
            </tr>   
        </thead>
        <tbody>
            <?php
            $result= $db->query('SELECT * FROM Client');
            $rows=$result->fetchAll();
//var_dump($rows);
            foreach ( $rows as $row){
            echo "<tr>
                    <td>" .$row["ID"]. "</td>
                    <td>" .$row["Nom"]. "</td>
                    <td>" .$row["Prenom"]. "</td>
                    <td>" .$row["Email"]. "</td>
                    <td>" .$row["Phone"]. "</td>
                    <td>" .$row["Passwords"]. "</td>
                    <td>" .$row["Adresse"]. "</td>
                    <td>" .$row["Hote"]. "</td>
                    <td field='date'>" .$row["DateCreation"]. "</td>
                    <td field='date'>" .$row["DateModification"]."</td>
                    <td><a href='PageClient.php?id=".$row["ID"]."&action=delete'>Delete 🚫</a> <a href='updateclient.php?id=".$row["ID"]."&action=update'>Update 🔄</ion-icon></a></td>
                </tr>";
            }

/*
}   
$action=$_POST['action'];
switch($action){
    case "create":
        $action="create";
        break;
    case "update":
        $action="update";
        break;
    case "delete":
        $action="delete";
        break;
}


if($isErr==false){
if($_SERVER["REQUEST_METHOD"]=="POST"){
    switch($action){
    case "create":
        include_once("insertion.php");
        break;
    case "update":
        include_once("update.php");
        break;
    case "delete":
        include_once("PageClient");
        break;
    default: //read
        break;
    }
}
else{
    //GET
};
}
*/
?>
</tbody>
</body>
</html>
