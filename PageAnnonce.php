<?php
    $message ="";
//DELETE
    if((isset($_GET['action']) && $_GET['action']=="delete")){
//Il faut faire pour quand delete a PageAnnonce
    
        require_once "./include/dbConn.php";
    
        $pdoStat = $pdo->prepare('DELETE FROM Annonce WHERE id=:ID');
        $pdoStat->bindValue(':ID', $_GET['id'], PDO::PARAM_INT);
        $executeOk = $pdoStat->execute();
    
        if($executeOk){
           $message = "L'annonce a été suprimé ✅";
        }
        else{
            $message = "Echec de la suppression l'annonce ❌";
        }
//echo($message);
    }
//UPDATE
    if((isset($_GET['action']) && $_GET['action']=="update")){
        require_once "./include/dbConn.php";
        $pdoStat = $pdo->prepare('UPDATE Annonce set Publication=:Publication, PrixHT=:PrixHT, Adresse=:Adresse  WHERE id=:ID');
        
        $pdoStat->bindValue(':ID', $_POST['ID'], PDO::PARAM_INT);
        $pdoStat->bindValue(':Publication', $_POST['Publication'], PDO::PARAM_STR);
        $pdoStat->bindValue(':PrixHT', $_POST['PrixHT'], PDO::PARAM_STR);
        $pdoStat->bindValue(':Adresse', $_POST['Adresse'], PDO::PARAM_STR);
        
        $executeOk = $pdoStat->execute();
//var_dump($executeOk);
        if($executeOk){
            $message = "L'annonce a été mis à jour ✅";
        }
        else{
            $message = "Echec de la mise à jour de l'annonce ❌";
        }
    }
//CREATE
    if((isset($_GET['action']) && $_GET['action']=="create")){
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
        
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            $pdo=null;

        require_once "./include/dbConn.php";    
            try{
                $sql = "INSERT INTO Annonce (ID, Publication, PrixHT, Adresse) VALUES
                (:ID, :Publication, :PrixHT, :Adresse)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':ID', $id);
                $stmt->bindParam(':Publication', $publication);
                $stmt->bindParam(':PrixHT', $prixht);
                $stmt->bindParam(':Adresse', $adresse);
                $stmt->execute();
                echo "L'annonce à bien été Créé ✅";
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
    <title>PageAnnonce</title>
</head>
<body>
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
    <h1>Table Annonce</h1>
        <table class="tableau-style">
        <a href="https://hautin.alwaysdata.net/Airbnb/newannonce.php" class="NouveauClient">🆕 New Annonce 🆕</a>
        <thead>
            <tr>
                <th>Id</th>
                <th>Publication</th>
                <th>PrixHT</th>
                <th>Adresse</th>
                <th>DateCreation</th>
                <th>DateModification</th>
                <th>Client_ID</th>
                <th>TypeImmo_ID</th>
                <th>Region_ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows= $db->query('SELECT * FROM Annonce');
//var_dump($rows);
            foreach ( $rows as $row) {
                echo "<tr>
                        <td>" .$row["ID"]. "</td>
                        <td>" .$row["Publication"]. "</td>
                        <td>" .$row["PrixHT"]. "</td>
                        <td>" .$row["Adresse"]. "</td>
                        <td field='date'>" .$row["DateCreation"]. "</td>
                        <td field='date'>" .$row["DateModification"]. "</td>
                        <td>" .$row["Client_ID"]. "</td>
                        <td>" .$row["Typelmmo_ID"]. "</td>
                        <td>" .$row["Region_ID"]. "</td>
                        <td><a href='PageAnnonce.php?id=".$row["ID"]."&action=delete'>Delete 🚫</a> <a href='updateannonce.php?id=".$row["ID"]."&action=update'>Update 🔄</a></td>
                    </tr>";
                }
            ?>
        </table>
        </tbody>
    </section>
    </body>
</html>