<?php
session_start();
require("../connect.php");
require ('../fonctions.php');
verifsessionadmin();

$nb_limit = $_POST["nb_limit"];
$sql = "SELECT rne,pass FROM membres LIMIT $nb_limit,20";
$result=mysql_query($sql);
while ($val=mysql_fetch_array($result)) {
	
	$rne = $val['rne'];
	$pass = $val['pass'];
	$email = $val['rne']."@ac-versailles.fr";
	$headers = "";
	$headers .="Cc: guy.fontaine@crdp.ac-versailles.fr"."\r\n";
	$headers .="From: ce.ia92.cabinet@ac-versailles.fr"."\r\n"; 
	$headers .='Reply-To: marc.laugerie@ac-versailles.fr'."\r\n"; 
	$headers .='Return-Path: marc.laugerie@ac-versailles.fr'."\r\n";
	$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\r\n"; 
	$headers .='Content-Transfer-Encoding: 8bit';
	
	$message ="Mesdames, Messieurs,\n\n";
	$message .="Chaque année, la Direction académique des Hauts-de-Seine édite un répertoire de chants et de chanson en rapport avec la thématique annuelle de Traverses92 : Jardins cette année.\n\n";
	$message .="Réalisé par une équipe de professeurs d’'éducation musicale du département ainsi que par la chorale des enfants de Levallois, cet outil est une ressource pédagogique, culturelle et artistique créée à l’intention des équipes des écoles primaires et des collèges des Hauts-de-Seine.\n\n";
	$message .="Les 11 titres qui le constituent et leur accompagnement musical, sont adaptés aux élèves de tous cycles, de la maternelle au collège. Ils permettent de mettre en place une pratique du chant choral dans de bonnes conditions : difficultés graduées, tessitures des voix d’ enfants respectées, textes riches et variés.\n\n";
	$message .="Un tel outil contribue à l ’élaboration d’une culture commune au sein des établissements, constitue un point d’ appui à la mise en ?uvre de projets inter degrés et permet d’ initier une réflexion avec les élèves dans le cadre de l’ enseignement de l histoire des arts.\n\n";
	$message .="Cette septième édition a été réalisée grâce au soutien du Conservatoire à Rayonnement Communal de Levallois-Perret, de l Atelier Canopé des Hauts-de-Seine, de l Office Central de la Coopération à l Ecole (OCCE 92).\n\n";
	$message .="Qu’ ils en soient vivement remerciés.\n\n";
	$message .="Philippe Wuillamier\n\n";
	$message .="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .="Comment accéder au  répertoire édition 2015 ?\n\n";
	$message .="Dans le cadre de la 7e édition du \"Répertoire92\" réalisé par la Direction académique des Hauts-de-Seine sur le thème \"Jardins\", vous avez la possibilité de télécharger 11 fichiers audio (chants et play-backs de la maternelle au collège) accompagnés des paroles et de ressources pédagogiques.\n\n";
	$message .="Pour ce faire, connectez-vous à l'adresse :\n";
	$message .="www.cd92.ac-versailles.fr/repertoire92/\n\n";
	$message .="Pour accéder à ces ressources, authentifiez-vous à l'aide des informations suivantes :\n";
	$message .="Nom d'utilisateur (code RNE de l'établissement) = ".$rne."\n";
	$message .="Mot de passe = ".$pass."\n\n";
	$message .="ATTENTION: Ce téléchargement peut prendre plusieurs minutes et sera disponible jusqu'au 30 janvier 2016.\n\n";
	$message .="Pour toute question, contacter Marc Laugenie :\n";
	$message .="marc.laugenie@ac-versailles.fr";
	
	mail($email,'repertoire Traverses 92, Edition 2015 : Jardins', $message, $headers);
	
	$sql_update = "UPDATE membres set mail=1 WHERE rne='$rne'";
	mysql_query($sql_update);

}
header("Location: admin.php?message2=". urlencode(utf8_encode("Emailing effectué !")));

?>