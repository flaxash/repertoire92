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
	$message .="Chaque ann�e, la Direction acad�mique des Hauts-de-Seine �dite un r�pertoire de chants et de chanson en rapport avec la th�matique annuelle de Traverses92 : Jardins cette ann�e.\n\n";
	$message .="R�alis� par une �quipe de professeurs d�'�ducation musicale du d�partement ainsi que par la chorale des enfants de Levallois, cet outil est une ressource p�dagogique, culturelle et artistique cr��e � l�intention des �quipes des �coles primaires et des coll�ges des Hauts-de-Seine.\n\n";
	$message .="Les 11 titres qui le constituent et leur accompagnement musical, sont adapt�s aux �l�ves de tous cycles, de la maternelle au coll�ge. Ils permettent de mettre en place une pratique du chant choral dans de bonnes conditions : difficult�s gradu�es, tessitures des voix d� enfants respect�es, textes riches et vari�s.\n\n";
	$message .="Un tel outil contribue � l ��laboration d�une culture commune au sein des �tablissements, constitue un point d� appui � la mise en ?uvre de projets inter degr�s et permet d� initier une r�flexion avec les �l�ves dans le cadre de l� enseignement de l histoire des arts.\n\n";
	$message .="Cette septi�me �dition a �t� r�alis�e gr�ce au soutien du Conservatoire � Rayonnement Communal de Levallois-Perret, de l Atelier Canop� des Hauts-de-Seine, de l Office Central de la Coop�ration � l Ecole (OCCE 92).\n\n";
	$message .="Qu� ils en soient vivement remerci�s.\n\n";
	$message .="Philippe Wuillamier\n\n";
	$message .="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .="Comment acc�der au  r�pertoire �dition 2015 ?\n\n";
	$message .="Dans le cadre de la 7e �dition du \"R�pertoire92\" r�alis� par la Direction acad�mique des Hauts-de-Seine sur le th�me \"Jardins\", vous avez la possibilit� de t�l�charger 11 fichiers audio (chants et play-backs de la maternelle au coll�ge) accompagn�s des paroles et de ressources p�dagogiques.\n\n";
	$message .="Pour ce faire, connectez-vous � l'adresse :\n";
	$message .="www.cd92.ac-versailles.fr/repertoire92/\n\n";
	$message .="Pour acc�der � ces ressources, authentifiez-vous � l'aide des informations suivantes :\n";
	$message .="Nom d'utilisateur (code RNE de l'�tablissement) = ".$rne."\n";
	$message .="Mot de passe = ".$pass."\n\n";
	$message .="ATTENTION: Ce t�l�chargement peut prendre plusieurs minutes et sera disponible jusqu'au 30 janvier 2016.\n\n";
	$message .="Pour toute question, contacter Marc Laugenie :\n";
	$message .="marc.laugenie@ac-versailles.fr";
	
	mail($email,'repertoire Traverses 92, Edition 2015 : Jardins', $message, $headers);
	
	$sql_update = "UPDATE membres set mail=1 WHERE rne='$rne'";
	mysql_query($sql_update);

}
header("Location: admin.php?message2=". urlencode(utf8_encode("Emailing effectu� !")));

?>