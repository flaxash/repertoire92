<?php
session_start();
require("../connect.php");
require ('../fonctions.php');
verifsessionadmin();

if (isset($_POST["compteur"]))
	{
		init_compteur($_POST['rne']);
		$info = "Le compteur a �t� initialis�";
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
	$message .="Chaque ann�e, la Direction acad�mique des Hauts-de-Seine �dite un r�pertoire de chants et de chanson en rapport avec la th�matique annuelle de Traverses92 : Toiles cette ann�e.\n\n";
	$message .="R�alis� par une �quipe de professeurs d��ducation musicale du d�partement ainsi que par la chorale des enfants de Levallois, cet outil est une ressource p�dagogique, culturelle et artistique cr��e � l�intention des �quipes des �coles primaires et des coll�ges des Hauts-de-Seine.\n\n";
	$message .="Les 7 titres qui le constituent et leur accompagnement musical, sont adapt�s aux �l�ves de tous cycles, de la maternelle au coll�ge. Ils permettent de mettre en place une pratique du chant choral dans de bonnes conditions : difficult�s gradu�es, tessitures des voix d�enfants respect�es, textes riches et vari�s.\n\n";
	$message .="Un tel outil contribue � l��laboration d�une culture commune au sein des �tablissements, constitue un point d�appui � la mise en �uvre de projets inter degr�s et permet d�initier une r�flexion avec les �l�ves dans le cadre de l�enseignement de l�histoire des arts.\n\n";
	$message .="Cette sixi�me �dition a �t� r�alis�e gr�ce au soutien du Conservatoire � Rayonnement Communal de Levallois-Perret, du Centre D�partemental de CANOP� Hauts-de-Seine, de l�Office Central de la Coop�ration � l�Ecole (OCCE 92).\n\n";
	$message .="Qu�ils en soient vivement remerci�s.\n\n";
	$message .="Philippe Wuillamier\n\n";
	$message .="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
	$message .="Comment acc�der au  r�pertoire �dition 2014 ?\n\n";
	$message .="Dans le cadre de la 6e �dition du \"R�pertoire92\" r�alis� par la Direction Acad�mique des Hauts-de-Seine sur le th�me \"Toiles\", vous avez la possibilit� de t�l�charger 7 fichiers audio (chants et play-backs de la maternelle au coll�ge) accompagn�s des paroles et de ressources p�dagogiques.\n\n";
	$message .="Pour ce faire, connectez-vous � l'adresse :\n";
	$message .="www.cd92.ac-versailles.fr/repertoire92/\n\n";
	$message .="Pour acc�der � ces ressources, authentifiez-vous � l'aide des informations suivantes :\n";
	$message .="Nom d'utilisateur (code RNE de l'�tablissement) = ".$rne."\n";
	$message .="Mot de passe = ".$pass."\n\n";
	$message .="ATTENTION: Ce t�l�chargement est possible jusqu'au 30 juin 2015.\n\n";
	$message .="Pour toute question, contacter Marc Laugenie :\n";
	$message .="marc.laugenie@ac-versailles.fr";
	
	mail($email,'repertoire Traverses 92, Edition 2014 : Toiles', $message, $headers);
	
	$sql_update = "UPDATE membres set mail=1 WHERE rne='$rne'";
	mysql_query($sql_update);

		
		$info = "Email envoy� � l'�tablissement";
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
