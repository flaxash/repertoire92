<?
require("../connect.php");
/*
$fichier_elementaire = "temp/elementaire.csv";
	$csv_elementaire = "LOAD DATA INFILE '$fichier_elementaire' IGNORE INTO test 
						FIELDS TERMINATED BY  ';'
						LINES TERMINATED BY  '\n'
						IGNORE 1 LINES
						(rne,type_ecole,nom_ecole,commune)";
	if(mysql_query($csv_elementaire)){
		echo "ok";
	} else {
		echo "merde";
		
	}
*/
$fichier_elementaire = "temp/elementaire.csv";
$handle = fopen($fichier_elementaire, "r");
if ($handle) {
    // decomposition de chaque ligne du fichier csv
    while (($data = fgetcsv($handle, 1000, ";", "\"")) !== FALSE) {
        $num = count($data)-1;
        // generation de la requete SQL
        $query = "INSERT INTO `test` VALUES (";
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
}
?>