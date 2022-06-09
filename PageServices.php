<?php
    $message ="";
//DELETE
    if((isset($_GET['action']) && $_GET['action']=="delete")){
//Il faut faire pour quand delete a PageClient
    
        require_once "./include/dbConn.php";
    
        $pdoStat = $pdo->prepare('DELETE FROM Services WHERE id=:ID');
        $pdoStat->bindValue(':ID', $_GET['id'], PDO::PARAM_INT);
        $executeOk = $pdoStat->execute();
    
        if($executeOk){
           $message = 'Le Services a été suprimé ✅';
        }
        else{
            $message = 'Echec de la suppression du Services ❌';
        }
//echo($message);
    }
//UPDATE
    if((isset($_GET['action']) && $_GET['action']=="update")){
        require_once "./include/dbConn.php";
        $pdoStat = $pdo->prepare('UPDATE Services set Libelle=:Libelle  WHERE id=:ID');
        
        $pdoStat->bindValue(':ID', $_POST['ID'], PDO::PARAM_INT);
        $pdoStat->bindValue(':Libelle', $_POST['Libelle'], PDO::PARAM_STR);
        
        $executeOk = $pdoStat->execute();
//var_dump($executeOk);
        if($executeOk){
            $message = 'Le Services a été mis à jour ✅';
        }
        else{
            $message = 'Echec de la mise à jour du Services ❌';
        }
    }
//CREATE
    if((isset($_GET['action']) && $_GET['action']=="create")){
        require_once "include/constantes.php";
        require_once "include/functions.php";
        $isErr=false;
        $action="c";
        
        $libelle = $prenom = $email = $phone = $password = $adresse = $hote ="";
        $libelleE = $prenomE = $emailE = $phoneE = $passwordE = $adresseE = $hoteE ="";
        if((isset($_POST['Valider']))){
//var_dump($_POST);
            if (empty($_POST["Libelle"])){
                $libelleE = "*";
                $isErr=true;
            }
            else{
                $libelle = test_input($_POST["Libelle"]);
            }
        
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            $pdo=null;

        require_once "./include/dbConn.php";    
            try{
                $sql = "INSERT INTO Services (ID, Libelle) VALUES
                (:ID, :Libelle)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':ID', $id);
                $stmt->bindParam(':Libelle', $libelle);

                $stmt->execute();
                echo "Le services à bien été Créé ✅";
            } catch(PDOException $e){
                die("ERROR: Could not able to execute $sql. " . $e->getMessage());
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>PageServices</title>
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
    <h1>Table Services</h1>
        <table class="tableau-style">
        <a href="https://hautin.alwaysdata.net/Airbnb/newservices.php" class="NouveauClient">🆕 New Services 🆕</a>
        <thead>
            <tr>
                <th>ID</th>
                <th>Libelle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows= $db->query('SELECT * FROM Services');
            //var_dump($rows);
            foreach ( $rows as $row) {
                echo "<tr>
                        <td>" .$row["ID"]. "</td>
                        <td>" .$row["Libelle"]. "</td>
                        <td><a href='PageServices.php?id=".$row["ID"]."&action=delete'>Delete 🚫</a> <a href='updateservices.php?id=".$row["ID"]."&action=update'>Update 🔄</ion-icon></a></td>
                    </tr>";
            }
            ?>
        </table>
        </tbody>
    </section>
    </body>
</html>