<html>
	<head>
		<style>
		table{
			border-style: solid;
			border-width: 1px;
			border-radius: 5px;
			background-color: green;
			
			
		}

		table tr:nth-child(even){
			background-color: #f2f2f2;
			
		}

		table tr:nth-child(odd) {
    		background: red;
		}

		th{
			background-color: green;
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

		$WID = Listar_Campos($servername,$username,$password,$dbname,$table,ocultar_campo,tam_div);
		echo "<div style=\"background-color: #6c7ae0; padding:5px; width:" .$WID ."em; text-align: center; color: white; align: center;\">";
		//echo "" .$COL1;
		Listar_Campos($servername,$username,$password,$dbname,$table,titulo_campo,tam_div);
		echo "</div>";
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
