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
		<h3>Téléchargements des établissements</h3>
	</div>
	
	<div class="row">
		<div class="span10">
			<table class="table">
			<tr style="background-color:#ff00cc;"><td>Commune</td><td>Nom</td><td>Compteur</td></tr>
			<?php
			foreach (liste_etab_compteur() as $etab) {
			?>
				<tr>
					<td><?php echo utf8_encode(strtoupper($etab['commune'])); ?></td>
					<td><?php echo utf8_encode(strtoupper($etab['rne']."<br>".$etab['type']." ".$etab['nom'])); ?></td>
					<td><span class="label label-warning"><?php echo $etab['compteur']; ?></span></td>
				</tr>
			<?php
			}
			?>
			
			</table>
		</div>
	</div>
	
</div>

<!-- Script -->
<script src="../js/jquery-1.8.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>