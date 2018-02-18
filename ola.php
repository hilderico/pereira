<?php

include 'myfunc.php';

echo "
<style>
table {
    border-collapse: collapse;
    
}

table, td, th {
    border: 1px solid black;
}

</style>
";

echo "<table width=\"300px\" border=\"1px\" border-collapse = \"collapse\" bordercolor=\"#FF0000\">"; 
echo "<tr>";
Listar_Campos("A002_ESTADOS",titulo_campo);

echo "</tr>";
Selecionar_Campos("A002_ESTADOS",tabelando);
echo "</table>";


?>


