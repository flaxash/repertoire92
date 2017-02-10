<?php
session_start();
require("connect.php");
require ('fonctions.php');

if (isset($_SESSION['idmembre'])) {
	
	//incrementation compteur de telechargement
	update_compteur($_SESSION['idmembre']);
	
	$_SESSION = array();
	session_destroy();
	$file = fopen("fichiers/repertoire92.zip", "rb");
	$message = true;
	
	header("Content-type: application/zip");
	header("Content-Disposition: attachment; filename=\"repertoire92.zip\"");
	header("Cache-control: private");
	while(!feof($file)) {
	    $buffer = fread($file, 1*(1024*1024));
	    echo $buffer;
	    ob_flush();
	    flush();
	}

	
} else {
	header('Location: index.php');
}


?>