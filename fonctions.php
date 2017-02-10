<?php

function verifpass($rne,$pass) {
	$sql = "SELECT id FROM membres WHERE rne='$rne' AND pass='$pass'";
	$exe=mysql_query($sql);
	$result=mysql_num_rows($exe);
	if($result != 0) {
		return mysql_fetch_array($exe);
	} else {
		return false;
	}
}

function verifcompteur($rne,$pass) {
	$sql = "SELECT compteur FROM membres WHERE rne='$rne' AND pass='$pass'";
	$result = mysql_query($sql);
	$val = mysql_fetch_array($result);
	if ($val['compteur']!=0){
		return true;
	} else {
		return false;
	}
}

function update_compteur($id) {
	$sql = "SELECT compteur FROM membres WHERE id = $id";
	$result = mysql_query($sql);
	$val = mysql_fetch_array($result);
	$new_compteur = $val["compteur"] - 1;
	$sql2 = "UPDATE membres SET compteur = $new_compteur WHERE id = $id";
	mysql_query($sql2);
}

function verifsessionadmin() {
	if (isset($_SESSION['connect_admin']) && $_SESSION['connect_admin'] == 1) {
		return true;
	}
	else {
		header('Location: index.php');
	}
}


function compteur() {
	$sql = "SELECT id FROM membres WHERE compteur !=2";
	$result=mysql_num_rows(mysql_query($sql));
		if ($result<100) {
			if ($result<10){
				echo "00".$result;
			} else {
				echo "0".$result;
			}	
		} else {
			echo $result;
		}
	
}

function liste_etab() {
	$return_array=array();
	$sql="SELECT id,rne,type,nom,commune FROM membres ORDER BY commune";
	$result=mysql_query($sql) or die("erreur requete liste_etab:" . mysql_error().":". $sql);
	while ($val=mysql_fetch_array($result)) {
		$return_array[ $val["id"] ]=$val;
	}
  	return $return_array;
}

function liste_etab_compteur() {
	$return_array=array();
	$sql="SELECT id,rne,compteur,type,nom,commune FROM membres WHERE compteur!=2 ORDER BY commune";
	$result=mysql_query($sql) or die("erreur requete liste_etab:" . mysql_error().":". $sql);
	while ($val=mysql_fetch_array($result)) {
		$return_array[ $val["id"] ]=$val;
	}
  	return $return_array;
}

function nom_etab($rne) {
	$sql = "SELECT type,nom,commune FROM membres WHERE rne='$rne'";
	$val=mysql_fetch_array(mysql_query($sql));
	echo utf8_encode($val['type']." ".$val['nom']." - ".$val['commune']);
}

function pass_etab($rne) {
	$sql = "SELECT pass FROM membres WHERE rne='$rne'";
	$val=mysql_fetch_array(mysql_query($sql));
	echo $val['pass'];
}

function compte_etab($rne) {
	$sql = "SELECT compteur FROM membres WHERE rne='$rne'";
	$val=mysql_fetch_array(mysql_query($sql));
	echo $val['compteur'];
}


function init_compteur($rne) {
	$sql = "UPDATE membres SET compteur=2 WHERE rne='$rne'";
	mysql_query($sql);
}

function reste_email() {
	$sql = "SELECT id FROM membres WHERE mail=0";
	$result=mysql_num_rows(mysql_query($sql));
	echo $result;
}

function calcul_limit() {
	$sql1 = "SELECT id FROM membres";
	$result1=mysql_num_rows(mysql_query($sql1));
	$sql2 = "SELECT id FROM membres WHERE mail=0";
	$result2=mysql_num_rows(mysql_query($sql2));
	$result = $result1 - $result2;
	
	echo $result;
}

function cherchepass($rne){
	$sql = "SELECT pass FROM membres WHERE rne='$rne'";
	$result=mysql_query($sql);
	return mysql_fetch_array($result);
}

?>