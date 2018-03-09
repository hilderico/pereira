<html>
	<head>
		<style>
		table{
			border-style: solid;
			border-width: 1px;
			border-radius: 5px;
			background-color: #6c7ae0;
			
			
		}

		table tr:nth-child(even){
			background-color: #f2f2f2;
			
		}

		table tr:nth-child(odd) {
    		background: red;
		}

		th{
			background-color: #6c7ae0;
color: white;
		}

		tr{
			border-collapse: collapse;
		}

		</style>

	</head>

	<body>
		<?php
		include 'myfunc.php';
		$servername = htmlspecialchars($_POST['servername']);
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$dbname = htmlspecialchars($_POST['dbname']);
		$table = htmlspecialchars($_POST['table']);

		?>


		<?php $COL1 = "Ola Ola Ola";		
		//$WID = strlen($COL1);

		$tamdiv1 = Listar_Campos($servername,$username,$password,$dbname,$table,ocultar_campo,tam_div) * 10;
		$tamdiv2 = Selecionar_Campos($servername,$username,$password,$dbname,$table,ocultar_campo,tam_div) * 10;
		
		if($tamdiv1 < $tamdiv2){
			$WID = $tamdiv2;
		}else
		if($tamdiv1 == $tamdiv2){
			$WID = $tamdiv2;
		}else
		{
			$WID = $tamdiv1;
		}
		
		echo "<div style=\"background-color: #6c7ae0; width:" .$WID ."px; align: center; color: white; align: center;\">";
		//echo "" .$COL1;
		echo "<table>";
		echo "<tr>";
		Listar_Campos($servername,$username,$password,$dbname,$table,titulo_campo,tam_div);
		echo "</tr>";
		Selecionar_Campos($servername,$username,$password,$dbname,$table,tabelando,tam_div);
		echo "</table>";
		echo "</div>";
		
/*		
		if($tamdiv1 < $tamdiv2){
	echo "maior tamdiv: \$tamdiv2. " .$tamdiv2 ."<br>";
}else
if($tamdiv1 == $tamdiv2){
	echo "tamanho iguais: \$tamdiv2. " .$tamdiv2 ."<br>";
}else
{
	echo "menor tamdiv: \$tamdiv1. " .$tamdiv1 ."<br>";
}

*/
		?>

		<br>
		<br>

		<table>
		<tr>
			<th> test </th>
			<th> test </th>
			<th> test </th>
		</tr>	

		<tr>
			<td> test asfasf</td>
			<td> test </td>
			<td> test dsafasfasf</td>
		</tr>	

		<tr>
			<td> test </td>
			<td> test asfasf </td>
			<td> test dsafasfasf</td>
		</tr>	
		</table>		
		
	</body>
</html>
