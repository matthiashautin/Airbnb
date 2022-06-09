<?php
    $message ="";
//DELETE
    if((isset($_GET['action']) && $_GET['action']=="delete")){
//Il faut faire pour quand delete a PageClient
    
        require_once "./include/dbConn.php";
    
        $pdoStat = $pdo->prepare('DELETE FROM Piece WHERE id=:ID');
        $pdoStat->bindValue(':ID', $_GET['id'], PDO::PARAM_INT);
        $executeOk = $pdoStat->execute();
    
        if($executeOk){
           $message = 'La Piece a été suprimé ✅';
        }
        else{
            $message = 'Echec de la suppression de la Piece ❌';
        }
//echo($message);
    }
//UPDATE
    if((isset($_GET['action']) && $_GET['action']=="update")){
        require_once "./include/dbConn.php";
        $pdoStat = $pdo->prepare('UPDATE Piece set Nom=:Nom  WHERE id=:ID');
        
        $pdoStat->bindValue(':ID', $_POST['ID'], PDO::PARAM_INT);
        $pdoStat->bindValue(':Nom', $_POST['Nom'], PDO::PARAM_STR);
        
        $executeOk = $pdoStat->execute();
//var_dump($executeOk);
        if($executeOk){
            $message = 'La Piece a été mis à jour ✅';
        }
        else{
            $message = 'Echec de la mise à jour de la Piece ❌';
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
        
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            $pdo=null;

        require_once "./include/dbConn.php";    
            try{
                $sql = "INSERT INTO Piece (ID, Nom) VALUES
                (:ID, :Nom)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':ID', $id);
                $stmt->bindParam(':Nom', $nom);

                $stmt->execute();
                echo "La Piece à bien été Créé ✅";
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
    <title>PagePiece</title>
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
    <h1>Table Piece</h1>
        <table class="tableau-style">
        <a href="https://hautin.alwaysdata.net/Airbnb/newpiece.php" class="NouveauClient">🆕 New Piece 🆕</a>
        <thead>
            <tr>
                <th>ID</th>
                <th>Piece</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows= $db->query('SELECT * FROM Piece');
            //var_dump($rows);
            foreach ( $rows as $row) {
                echo "<tr>
                        <td>" .$row["ID"]. "</td>
                        <td>" .$row["Nom"]. "</td>
                        <td><a href='PagePiece.php?id=".$row["ID"]."&action=delete'>Delete 🚫</a> <a href='updatepiece.php?id=".$row["ID"]."&action=update'>Update 🔄</ion-icon></a></td>
                    </tr>";
            }
            ?>
        </table>
        </tbody>
    </section>
    </body>
</html>