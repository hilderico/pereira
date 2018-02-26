<?php
ini_set('display_errors',1);


$arquivo = "contador.txt";
$contador = 0;

$fp = fopen($arquivo,"r");
$contador = fgets($fp, 26);
fclose($fp);

$contador = $contador + 1;

$fp = fopen($arquivo,"w");
fwrite($fp, $contador, 26);
fclose($fp);

echo "Esta página foi visitada $contador vezes";
?> 
