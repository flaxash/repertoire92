<?php
$file = fopen("http://xmlgraphics.apache.org/fop/examples.pdf", "rb");
 
if($file)
{
    header("Content-type: application/pdf");
    header("Content-Disposition: attachment; filename=\"fichier.pdf\"");
    header("Cache-control: private");
    while(!feof($file)) {
        $buffer = fread($file, 1*(1024*1024));
        echo $buffer;
        ob_flush();
        flush();
    }
}else
{
    exit('error');
}

?>