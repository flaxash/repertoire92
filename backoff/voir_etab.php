<?php
session_start();
require("../connect.php");
require ('../fonctions.php');
verifsessionadmin();

if (isset($_POST["compteur"]))
	{
		init_compteur($_POST['rne']);
		$info = "Le compteur a été initialisé";
	}

if (isset($_POST["email"]))
	{
	$rne = $_POST['rne'];
	$val = cherchepass($rne);
	$pass = $val['pass'];
	$email = $rne."@ac-versailles.fr";
	$headers = "";
	$headers .="Cc: guy.fontaine@crdp.ac-versailles.fr"."\r\n";
	$headers .="From: ce.ia92.cabinet@ac-versailles.fr"."\r\n"; 
	$headers .='Reply-To: marc.laugerie@ac-versailles.fr'."\r\n"; 
	$headers .='Return-Path: marc.laugerie@ac-versailles.fr'."\r\n";
	$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\r\n"; 
	$headers .='Content-Transfer-Encoding: 8bit';
	
	$message ="Mesdames, Messieurs,\n\n";
	$message .="Chaque année, la Direction académique des Hauts-de-Seine édite un répertoire de chants et de chanson en rapport avec la thématique annuelle de Traverses92 : Toiles cette année.\n\n";
	$message .="Réalisé par une équipe de professeurs d’éducation musicale du département ainsi que par la chorale des enfants de Levallois, cet outil est une ressource pédagogique, culturelle et artistique créée à l’intention des équipes des écoles primaires et des collèges des Hauts-de-Seine.\n\n";
	$message .="Les 7 titres qui le constituent et leur accompagnement musical, sont adaptés aux élèves de tous cycles, de la maternelle au collège. Ils permettent de mettre en place une pratique du chant choral dans de bonnes conditions : difficultés graduées, tessitures des voix d’enfants respectées, textes riches et variés.\n\n";
	$message .="Un tel outil contribue à l’élaboration d’une culture commune au sein des établissements, constitue un point d’appui à la mise en œuvre de projets inter degrés et permet d’initier une réflexion avec les élèves dans le cadre de l’enseignement de l’histoire des arts.\n\n";
	$message .="Cette sixième édition a été réalisée grâce au soutien du Conservatoire à Rayonnement Communal de Levallois-Perret, du Centre Départemental de CANOPÉ Hauts-de-Seine, de l’Office Central de la Coopération à l’Ecole (OCCE 92).\n\n";
	$message .="Qu’ils en soient vivement remerciés.\n\n";
	$message .="Philippe Wuillamier\n\n";
	$message .="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .="Comment accéder au  répertoire édition 2014 ?\n\n";
	$message .="Dans le cadre de la 6e édition du \"Répertoire92\" réalisé par la Direction Académique des Hauts-de-Seine sur le thème \"Toiles\", vous avez la possibilité de télécharger 7 fichiers audio (chants et play-backs de la maternelle au collège) accompagnés des paroles et de ressources pédagogiques.\n\n";
	$message .="Pour ce faire, connectez-vous à l'adresse :\n";
	$message .="www.cd92.ac-versailles.fr/repertoire92/\n\n";
	$message .="Pour accéder à ces ressources, authentifiez-vous à l'aide des informations suivantes :\n";
	$message .="Nom d'utilisateur (code RNE de l'établissement) = ".$rne."\n";
	$message .="Mot de passe = ".$pass."\n\n";
	$message .="ATTENTION: Ce téléchargement est possible jusqu'au 30 juin 2015.\n\n";
	$message .="Pour toute question, contacter Marc Laugenie :\n";
	$message .="marc.laugenie@ac-versailles.fr";
	
	mail($email,'repertoire Traverses 92, Edition 2014 : Toiles', $message, $headers);
	
	$sql_update = "UPDATE membres set mail=1 WHERE rne='$rne'";
	mysql_query($sql_update);

		
		$info = "Email envoyé à l'établissement";
	}

?>

<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>REPERTOIRE 92 - BackOFF</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
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
	
	<div class="page-header">
		<a href="admin.php"><button class="btn btn-inverse" type="button"><i class="icon-arrow-left icon-white"></i> Retour menu</button></a>
		<h3>Etablissement</h3>
	</div>
	
	<div class="row">
	
		<div class="span9 offset1">
			<h3><?php nom_etab($_POST['rne']); ?></h3>
		</div>
		
		<div class="span4 offset1">
			<h4>mot de passe : <span class="label label-info"><? pass_etab($_POST['rne']); ?></span></h4>
			<h4>compteur : <span class="label label-warning"><? compte_etab($_POST['rne']); ?></span></h4>
		</div>
	
	</div>
	
	<div class="row">
		
		<div class="span9 offset1">
			<hr>
			<?php
			if (isset($info)) {
			?>
				<div class="alert fade in">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><?php echo $info; ?></strong>
				</div>
			<?php
			}
			?>
		</div>
		
		<div class="span4 offset1">
			<form method='post'>
				<input type="hidden" name="rne" value="<?php echo $_POST['rne']; ?>">
				<button type="submit" name="compteur" class="btn btn-primary">Initialiser compteur</button>
			</form>
		</div>
		
		<?php if (!isset($_POST["email"])) { ?>
		<div class="span4 offset1">
			<form method='post'>
				<input type="hidden" name="rne" value="<?php echo $_POST['rne']; ?>">
				<button type="submit" name="email" class="btn btn-primary">Envoyer email</button>
			</form>
		</div>
		<?php } ?>
		
	</div>
	
</div>

<!-- Script -->
<script src="../js/jquery-1.8.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
