<?php
$MessageErr = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    // Connexion à la base de donnée
    require_once "./include/dbConn.php";
	$pass=md5($pass);
    $sql = "SELECT * FROM Client WHERE Email = :email AND Passwords = :passwords";
    $result = $pdo->prepare($sql);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':passwords', $pass, PDO::PARAM_STR);
    $result->execute();
    $data = $result->fetchAll();
    $count = $result->rowCount();
    echo $count;
    if ($count == 1 && !empty($data)) {
        session_start();
        $_SESSION['email'] = $data[0]['Email'];
        header('Location: ./PageClient.php');
        exit();
    }
    else {
        $MessageErr = "Email ou mot de passe incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style/index.css">
	<title>Login</title>
</head>
<body>
		<p>Form Login <br>
			test@gmail.com / test
		<br>
		</p>
		<form action="login.php" method="post">
			<label type="email "for="email">Email</label><br>
				<input type="text" name="email" required><br>
			<label for="password">Password</label><br>
				<input type="password" name="password" required><br>
			<input type="submit" name="submit" value="Envoyer">
			<h3><?= $MessageErr?></h3>
		</form>
</body>
</html>
