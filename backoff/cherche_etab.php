<?php
session_start();
require("../connect.php");
require ('../fonctions.php');
verifsessionadmin();

$term = trim(strip_tags($_GET['term']));

$sql = "SELECT * FROM membres WHERE rne LIKE '%".$term."%' OR commune LIKE '%".$term."%'";
$result=mysql_query($sql) or die("erreur requete nom_etab_par_rne:" . mysql_error().":". $sql);

$return_arr = array();
while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
{
		$row_array['value'] = trim($row['rne']);
		$row_array['label'] = utf8_encode($row['type']." ".trim($row['nom'])." ".trim($row['commune']));
        array_push($return_arr,$row_array);

}
echo json_encode($return_arr);

?>