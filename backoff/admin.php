<?php
session_start();
require("../connect.php");
require ('../fonctions.php');
verifsessionadmin();
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>REPERTOIRE 92 - BackOFF</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
	<link href="../css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
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
		<h1>Compteur de téléchargements</h1>
	</div>
	
	<div class="row">
		
		<div class="span4 offset1">
			<a href="#" class="btn btn-large btn-warning"><h1><?php compteur(); ?></h1></a>
		</div>
		
		<div class="span4 offset1">
			<a href="voir_comptage.php"><button class="btn btn-large btn-primary" type="button">Voir les établissements</button></a>
		</div>
	</div>
	
</div>

<div class="container" style="margin-top:50px;">
	<div class="page-header">
		<h1>Gestion des établissements</h1>
	</div>
	
	<div class="row">
		<div class="span9 offset1">
			<h3>Infos et Modifications</h3>
		</div>
		
		<div class="span4 offset1">
			<form action="voir_etab.php" method="post">
				<label for="rne">Etablissement (RNE ou Ville)</label>
				<div class="input">
					<input id="rne" name="rne" type="text" class="UpperCase">
				</div>
				<div class="submit">
					<input type="submit" class="btn btn-primary" name="chercher" value="voir">
				</div>
			</form>
		</div>
		
		<div class="span4 offset1">
			Accès aux fonctions suivantes :<br>
			<li>Mot de passe de l'établissement</li>
			<li>Re-initialisaiton du compteur de téléchargement</li>
			<li>Envoi simple de l'email</li>
		</div>
		
	</div>
	
	<div class="row">
		
		<div class="span9 offset1">
			<hr>
			<h3>Importation Base</h3>
		</div>
		
		<div class="span4 offset1">
			<?php
			if (isset($_GET["message1"])) {
			?>
				<div class="alert fade in">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><?php echo $_GET["message1"]; ?></strong>
				</div>
			<?php } ?>
			
			<form id="form1" name='form1' method='post' action="import_basetab.php" enctype='multipart/form-data'>
				<label>Dernière importation :<br />
					<?php 
						$fbe = "dateimport_basetab.txt";
						if (file_exists($fbe)) {
							$rbe = fopen("dateimport_basetab.txt","r");
							$lbe = fgets($rbe);
							echo "<span style=\"color:yellow;\">".$lbe."</span>";
						} else { echo "<span style=\"color:yellow;\">...</span>"; }
					?>
					</label><br />
				</label>
				<div class="input">
				<input type="file" name="fichier_basetab" value="fichier_basetab">
				</div>
				<div class="submit">
				<input type="button" id="btnform1" value="Envoyer" class="btn btn-primary">
				</div>
			</form>
			<div id="charg1" class="well well-small">
				<img src="../img/loader2.gif"><span style="color:#000;">&nbsp;Traitement en cours...</span>
			</div>
		</div>
		
		<div class="span4 offset1">
			<a href="voir_basetab.php"><button class="btn btn-large btn-primary" type="button">Visualiser la base</button></a>
		</div>
		
		<div class="span9 offset1">
			<div class="alert alert-error">
			ATTENTION !! L'importation des étalissements à partir du fichier CSV re-initialise tous les compteurs de téléchargement, ainsi que les mots de passe.
			</div>
		</div>
		
	</div>
	
	
	<div class="row">
		<div class="span9 offset1">
			<hr>
			<h3>Emailing</h3>
			Email restant à envoyer : <?php reste_email(); ?><br><br>&nbsp;
		</div>
	</div>
	
	<div class="row">	
		<div class="span4 offset1">
			<?php
			if (isset($_GET["message2"])) {
			?>
				<div class="alert fade in">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><?php echo $_GET["message2"]; ?></strong>
				</div>
			<?php } ?>
			
			<form id="form2" name='form2' method='post' action="emailing.php">
				<div class="submit">
					<input type="hidden" name="nb_limit" value="<?php calcul_limit(); ?>">
					<input type="button" id="btnform2" value="Lancer envoi paquet" class="btn btn-primary">
				</div>
			</form>
			<div id="charg2" class="well well-small">
				<img src="../img/loader2.gif"><span style="color:#000;">&nbsp;Traitement en cours...</span>
			</div>
		</div>
		
		<div class="span4 offset1">
			L'envoi d'email contenant les informations nécessaires au téléchargement sera envoyé par paquet de 25.
		</div>
		
	</div>
	
</div>

<!-- Script -->
<script src="../js/jquery-1.8.0.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	
	$('#charg1').hide();
	
	$('#btnform1').click(function() {
		$('#charg1').show();
		$('#form1').slideUp(function () {
			$('#form1').submit();
		});
	});
	
	$('#charg2').hide();
	
	$('#btnform2').click(function() {
		$('#charg2').show();
		$('#form2').slideUp(function () {
			$('#form2').submit();
		});
	});
	
	$('#rne').autocomplete({
		source: 'cherche_etab.php',
		minLength: 2
	});
	
});
</script>
</body>
</html>