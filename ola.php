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

echo "<div style=\"overflow: auto; width: 640px; height: 640px\">";

echo "<table>"; 
echo "<tr>";
Listar_Campos("A001_PAIS",titulo_campo);

echo "</tr>";
Selecionar_Campos("A001_PAIS",tabelando);
echo "</table>";
echo "</div>";

?>


