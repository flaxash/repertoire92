<?php
session_start();
require("../connect.php");
require ('../fonctions.php');

if(isset($_POST["connexion"]) && !empty($_POST['login']) && !empty($_POST['pass'])) {
	
	$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
	$pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
	
	if ($login == "admincd92" && $pass == "183cd92"){
		$_SESSION['connect_admin'] = 1;
		header('Location: admin.php');
	} else {
		header('Location: index.php');
	}
		
}

?>


<!DOCTYPE HTML>
<html>

<head>
	<title>REPERTOIRE 92 - BackOFF</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link href="../css/bootstrap.css" rel="stylesheet">
</head>

<body style="color:#fff;">

<div style="width:940px;margin:auto;">
	<div class="navbar">
		<div class="navbar-inner">
		<h1 style="text-align:center;">Repertoire 92 - BackOffice</h1>
		</div>
	</div>
</div>


<div class="container">
	<div class="row" style="margin-top:10px;">
		<div class="span5 offset4">
			<form action="index.php" method="post">
					<label for="nom">Login</label>
					<div class="input">
						<input id="login" name="login" type="text">
					</div>
					<label for="pass">Mot de Passe</label>
					<div class="input">
						<input id="pass" name="pass" type="password" value="">
					</div>
					<div class="submit">
						<input type="submit" class="btn" name="connexion" value="se connecter">
					</div>
			</form>
		</div>
	</div>
</div>

<!-- Script -->
<script src="../js/jquery-1.8.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="js/ajoutscript.js"></script>

</body>
</html>