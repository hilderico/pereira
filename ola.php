<?php
ini_set('display_errors', '1');


include 'myfunc.php';

$servername = htmlspecialchars($_POST['servername']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$dbname = htmlspecialchars($_POST['dbname']);
$table = htmlspecialchars($_POST['table']);

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
$tamdiv1 = Listar_Campos($servername,$username,$password,$dbname,$table,titulo_campo,tam_div);

//retu_ret
//tam_div


echo "</tr>";
$tamdiv2 = Selecionar_Campos($servername,$username,$password,$dbname,$table,tabelando,tam_div);
//Listar_Tabelas($servername,$username,$password,$dbname);
echo "</table>";
echo "</div>";

echo "<br><br> TAM DA DIV_1 = " .$tamdiv1 ."<br>";
echo "<br><br> TAM DA DIV_2 = " .$tamdiv2 ."<br>";

if($tamdiv1 < $tamdiv2){
	echo "maior tamdiv: \$tamdiv2. " .$tamdiv2 ."<br>";
}else
if($tamdiv1 == $tamdiv2){
	echo "tamanho iguais: \$tamdiv2. " .$tamdiv2 ."<br>";
}else
{
	echo "menor tamdiv: \$tamdiv1. " .$tamdiv1 ."<br>";
}

?>


