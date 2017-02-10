<?php
$host = $_SERVER['SERVEUR_MYSQL']; //Votre host, souvent localhost
$user = 'crdp-versailles'; //votre login
$pass = 'cr&Dp_v3R$a1LleS;'; //Votre mot de passe
$db = 'versailles_db17'; // Le nom de la base de donnee

$link = mysql_connect ($host,$user,$pass) or die ('Erreur : '.mysql_error());
mysql_select_db($db) or die ('Erreur :'.mysql_error());
?>
