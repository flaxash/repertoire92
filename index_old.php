<?php
session_start();
require("connect.php");
require ('fonctions.php');

if (isset($_POST['down']) && !empty($_POST['rne']) && !empty($_POST['pass'])){
	
	$rne = mysql_real_escape_string(htmlspecialchars($_POST['rne']));
	$pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
	
	if(verifpass($rne,$pass)){
		
		if(verifcompteur($rne,$pass)){
			$val = verifpass($rne,$pass);
			$_SESSION['idmembre'] = $val['id'];
			
			$download = "ok";
		} else {
			$download = "compteur";
		}
		
	} else {
		$download = false;
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>REPERTOIRE 92</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>

<body>

<div class="container" style="background-color:#fff;">

	<div class="row">
		<div class="span3 offset1">
			<a href="index.php"><img src="img/logo_traverse92.jpg" border="0"></a>
		</div>
		<div class="span8">
			<h2>Le répertoire 92 « Toiles … »<br>2015-2016</h2>
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		
		<div class="span10 offset1">
		Le répertoire 92 « Toiles … » est une ressource départementale visant à développer la pratique du chant dans le cadre du socle commun et de l’histoire des arts.
		Il s’adresse aux enseignants des écoles primaires et des collèges et peut permettre des projets inter degrés.<br>
		Il est composé de :
			<ul>
				<li>11 titres de styles variés</li>
				<li>11 accompagnements instrumentaux</li>
				<li>Un guide pédagogique « La loupe à l’oreille » pour sa mise en œuvre en classe à l’attention des enseignants non musiciens.</li>
				<li>Des fiches culturelles</li>
			</ul>
		<br>&nbsp;
		</div>
		
	</div>

</div>

<div class="container" style="height:280px;background-color:#fff;padding-top:30px;background-image:url(img/fond_encart_btn.png);background-repeat: no-repeat;background-position:center top;">

	<div class="row" style="margin-top:10px;">
		
			<?php
			if(isset($_POST['identification'])) {
			?>	
				<div class="span3 offset3">
					<form method="post" class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="rne">Etablissement (RNE)</label>
							<div class="controls">
						      <input id="rne" name="rne" type="text" class="UpperCase">
						    </div>
						</div>
						<div class="control-group">
							<label class="control-label" for="pass">Mot de Passe</label>
							<div class="controls">
						     <input id="pass" name="pass" type="password" value="">
						    </div>
						</div>
						<div class="control-group">
						    <div class="controls">
						    <input type="submit" class="btn" name="down" value="Télécharger">
						    </div>
						</div>
					</form>
				</div>
			
			<?php	
			} else if (isset($_POST['down'])){
			?>
					<div class="span3 offset3">
						<?php 
						if($download == "ok") {
							nom_etab($_POST['rne']);
						?>
							<br><br>
							Téléchargement : <a href="telecharger.php">repertoire92</a>
						<? 
						} else if($download == "compteur"){
						?>
						<div class="alert alert-info">
						Vous avez dépassé votre quota de téléchargement.<br><br>Contacter<br>le <a href="mailto:marc.laugenie@ac-versailles.fr">responsable</a> <i class="icon-envelope"></i>
						</div>
						<? 
						} else {
						?>
						<div class="alert alert-error">Erreur d'identifiants !</div>
						<form method="post" class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="rne">Etablissement (RNE)</label>
							<div class="controls">
						      <input id="rne" name="rne" type="text" class="UpperCase">
						    </div>
						</div>
						<div class="control-group">
							<label class="control-label" for="pass">Mot de Passe</label>
							<div class="controls">
						     <input id="pass" name="pass" type="password" value="">
						    </div>
						</div>
						<div class="control-group">
						    <div class="controls">
						    <input type="submit" class="btn" name="down" value="Télécharger">
						    </div>
						</div>
						</form>
						<?php	
						}
						?>
					</div>
					
			
			<?php
			} else {
			?>
				<div class="span3 offset3">
					<form method="post">
						<button class="btn btn-large btn-primary" type="submit" name="identification">Télécharger<br>le répertoire92</button>
					</form>
				</div>
				
				<div class ="span3 offset 1">
					<a href="methode.html"><button class="btn btn-large" type="button">Accès à la méthode<br>la loupe à l'oreille</button></a>
				</div>
			<?php
			}
			?>
			
		</div>
		
	</div>

</div>


<!--<div class="container" style="background-color:#fff;">

	<div class="row" style="margin-bottom:25px;">
		<div class="span10 offset1">
			<div class="span1">
				<a href="fichiers/FIche_le_petit_mercelot.pdf" alt="FIche_le_petit_mercelot" target="_blank"><img src="img/fiche/fiche_mercelot.jpg" class="fiche"></a>
			</div>
			<div class="span8">
				<a href="fichiers/FIche_Manha_de_carnaval.pdf" alt="FIche_Manha_de_carnaval" target="_blank"><h3 style="margin-top:0px;">"Le petit mercelot"</h3></a>
				Chant traditionnel, Ille-et-Vilaine. Le thème dominant est les métiers itinérants d'autrefois (XiXème siècle)
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="span10 offset1">
			<div class="span1">
				<a href="fichiers/FIche_Manha_de_carnaval.pdf" alt="FIche_Manha_de_carnaval" target="_blank"><img src="img/fiche/fiche_manha.jpg" class="fiche"></a>
			</div>
			<div class="span8">
				<a href="fichiers/FIche_Manha_de_carnaval.pdf" alt="FIche_Manha_de_carnaval" target="_blank"><h3 style="margin-top:0px;">"Manha de carnaval"</h3></a>
				Thème dominant : Le mythe d’Orphée transposé à Rio de Janeiro pendant le carnaval.
			</div>
		</div>
	</div></div>-->

</div>

<div class="container" style="background-color:#fff;">

	<div class="page-header">
	</div>

</div>



<!-- Script -->
<script src="js/jquery-1.8.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/ajoutscript.js"></script>

</body>
</html>