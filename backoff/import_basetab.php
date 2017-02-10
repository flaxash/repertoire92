<?php
session_start();
require("../connect.php");
require ('../fonctions.php');
verifsessionadmin();
date_default_timezone_set('Europe/Berlin');

$tmp_file = $_FILES['fichier_basetab']['tmp_name'];
$format_fichier = ".csv";
$extension = strrchr($_FILES['fichier_basetab']['name'], '.');
if(is_uploaded_file($tmp_file) && $format_fichier == $extension)
{
	$fichier = "basetab.csv";
	$reptemp = "temp/";
	move_uploaded_file($tmp_file,$reptemp.$fichier);
		
	$fichier_basetab = $reptemp.$fichier;
	//$fichier_basetab = 'temp/elementaire.csv';

	$handle = fopen($fichier_basetab, "r");
	if ($handle) {
	    // decomposition de chaque ligne du fichier csv
	    while (($data = fgetcsv($handle, 1000, ";", "\"")) !== FALSE) {
	        $num = count($data)-1;
	        // generation de la requete SQL
	        $query = "INSERT INTO `import` VALUES (";
	        for ($c=0; $c < $num; $c++) {
	            $query .= "'" . mysql_real_escape_string($data[$c]) ."',";
	        }
	        $query .= "'" . mysql_real_escape_string($data[$num]) ."')";
	        // insertion de la ligne dans la base MySQL
	        mysql_query($query) or die (mysql_error());
	        $query = NULL;
	    }
	    // fermeture du fichier csv
	    fclose($handle);
	    
	    $viderbase = "TRUNCATE membres";
	    mysql_query($viderbase);
	    
	    $sql_import = "SELECT rne,type,nom,commune FROM import";
	    $result_import = mysql_query($sql_import);
	    while ($val=mysql_fetch_array($result_import)) {
	    	
	    	//recuperation des valeurs
	    	$rne = $val['rne'];
	    	$type = mysql_real_escape_string($val['type']);
	    	$nom = mysql_real_escape_string($val['nom']);
	    	$commune = mysql_real_escape_string($val['commune']);
	    	
	    	//creation d'un pass aléatoire
	    	$code='';
	    	for($i=0; $i<10; $i++) {
				$code .= substr('0123456789azertyuiopmlkjhgfdsqwxcvbn',(rand()%(strlen('0123456789azertyuiopmlkjhgfdsqwxcvbn'))),1);
			}
			
			//insertion dans la base
			$sql = "INSERT INTO membres(rne,pass,compteur,type,nom,commune,mail) VALUES ('$rne','$code',2,'$type','$nom','$commune',0)";
			mysql_query($sql);
	    }
	    
	    ////// date de l'import
		$datedujour = date('d/m/Y H:i');
		$fichier_dateimport = fopen ("dateimport_basetab.txt", "w+");
		fputs ($fichier_dateimport, $datedujour);
		fclose ($fichier_dateimport);
	    
	    //vider la table import
	    $vidertable = "TRUNCATE import";
	    mysql_query($vidertable);
	    
	    //effacer fichier temp csv
	    @unlink($fichier_basetab);
	    
	    header("Location: admin.php?message1=". urlencode("ok fichier"));
	    
	} else {
		header("Location: admin.php?message1=". urlencode("Erreur fichier !"));
	}
	
}
else
{
	header("Location: admin.php?message1=". urlencode("Erreur fichier !"));
}	

?>