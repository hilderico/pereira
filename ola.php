<?php

include 'myfunc.php';

$servername = htmlspecialchars($_POST['servername']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$dbname = htmlspecialchars($_POST['dbname']);

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

echo "<div style=\"overflow: auto; width: 640px; height: 480px\">";

echo "<table>"; 
echo "<tr>";
Listar_Campos($servername,$username,$password,$dbname,"A001_PAIS",titulo_campo);


echo "</tr>";
Selecionar_Campos($servername,$username,$password,$dbname,"A001_PAIS",tabelando);
echo "</table>";
echo "</div>";

?>


