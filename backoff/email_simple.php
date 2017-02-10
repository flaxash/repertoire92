<?php
session_start();
require("../connect.php");
require ('../fonctions.php');
verifsessionadmin();


	
	$rne = $_POST['rne'];
	$val = cherchepass($rne);
	$pass = $val['pass'];
	//$email = $val['rne']."@ac-versailles.fr";
	$email = "david.perissinotto@ac-versailles.fr";
		
	$headers ='From: "ce.ia92.cabinet"<ce.ia92.cabinet@ac-versailles.fr>'."\n"; 
	$headers .='Reply-To: marc.laugerie@ac-versailles.fr'."\n"; 
	$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n"; 
	$headers .='Content-Transfer-Encoding: 8bit';
	
	$message ="Chaque année, la Direction académique des Hauts-de-Seine édite un répertoire de chants et de chanson en rapport avec la thématique annuelle de Traverses92 : Traversées cette année\n\n";
	$message .="Réalisé par une équipe de professeurs d’éducation musicale du département ainsi que par des musiciens professionnels, cet outil est une ressource pédagogique, culturelle et artistique créée à l’intention des équipes des écoles primaires et des collèges des Hauts-de-Seine.\n\n";
	$message .="Les 11 titres qui le constituent et leur accompagnement musical, sont adaptés aux élèves de tous cycles, de la maternelle au collège. Ils permettent de mettre en place une pratique du chant choral dans de bonnes conditions : difficultés graduées, tessitures des voix d’enfants respectées, textes riches et variés.\n\n";
	$message .="Un tel outil contribue à l’élaboration d’une culture commune au sein des établissements, constitue un point d’appui à la mise en œuvre de projets inter degrés et permet d’initier une réflexion avec les élèves dans le cadre de l’enseignement de l’histoire des arts.\n\n";
	$message .="Cette cinquième édition a été réalisée grâce au soutien de la Délégation Académique à l’Action Culturelle du rectorat de Versailles, du Conservatoire à Rayonnement Communal de Levallois-Perret, du Centre Départemental de Documentation Pédagogique des Hauts-de-Seine (CDDP 92), de l’Office Central de la Coopération à l’Ecole (OCCE 92). Qu’ils en soient vivement remerciés.\n\n";
	$message .="Édouard Rosselet\n\n";
	$message .="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .="Comment accéder au  répertoire édition 2013 ?\n\n";
	$message .="Dans le cadre de la 6e édition du \"Répertoire92\" réalisé par la Direction Académique des Hauts-de-Seine sur le thème \"Traversées\", vous avez la possibilité de télécharger 11 fichiers audio (chants et play-backs de la maternelle au collège) accompagnés des paroles et de ressources pédagogiques.\n\n";
	$message .="Pour ce faire, connectez-vous à l'adresse :\n";
	$message .="www.cd92.ac-versailles.fr/repertoire92/\n\n";
	$message .="Pour accéder à ces ressources, authentifiez-vous à l'aide des informations suivantes :\n";
	$message .="Nom d'utilisateur (code RNE de l'établissement) = ".$rne."\n";
	$message .="Mot de passe = ".$pass."\n\n";
	$message .="ATTENTION: Ce téléchargement est possible jusqu'au 31 octobre 2013.\n\n";
	$message .="Pour toute question, contacter Marc Laugenie :\n";
	$message .="marc.laugenie@ac-versailles.fr";
	
	mail($email,'répertoire Traverses 92 édition 2013 : Traversées', $message, $headers);
	
	$sql_update = "UPDATE membres set mail=1 WHERE rne='$rne'";
	mysql_query($sql_update);


header("Location: voir-etab.php?message=". urlencode(utf8_encode("Email envoyé !")));
	
?>