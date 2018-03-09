<?php


header('Content-Type: text/html; charset=utf-8');
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

define('mostrar_campo', '1');
define('ocultar_campo', '0');
define('titulo_campo', '2');
define('testando', '3');
define('tabelando', '4');
define('tam_div', '5');
define('retu_ret', '6');


function Listar_Bases($lservername,$lusername,$lpassword){
	$servername = $lservername;
	$username = $lusername;
	$password = $lpassword;

	$link = mysql_connect($servername, $username, $password);
	$res = mysql_query("SHOW DATABASES");

	while ($row = mysql_fetch_assoc($res)) {
    	echo $row["Database"] . "\n";
	}
	mysqli_close($link);
}

function Listar_Tabelas($lservername,$lusername,$lpassword,$ldbname){
	$servername = $lservername;
	$username = $lusername;
	$password = $lpassword;
	$dbname = $ldbname;

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "show tables";
	$res = $conn->query($sql);

	while ($row = $res->fetch_assoc()) {
    	echo $row["Tables_in_$dbname"] . "<br>";
	}	

	mysqli_close($conn);
}



function Listar_Campos($lservername,$lusername,$lpassword,$ldbname,$TABLE,$OPCAO,$mosdiv){
	$tamdiv = 0;
	$temptamdiv = 0;


	$servername = $lservername;
	$username = $lusername;
	$password = $lpassword;
	$dbname = $ldbname;

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "desc $TABLE";
	$res = $conn->query($sql);	
	
	$x = 0;
		
	while ($row = $res->fetch_assoc()) {
    		
		$RET[$x] = $row["Field"];		
		$x++;
	}
	
	if($OPCAO == mostrar_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			echo "Field -> " . $RET[$x] . "<br>";
			$tamdiv = $tamdiv + strlen($RET[$x]);
		}
	}
	if($OPCAO == titulo_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			echo "<th>" . $RET[$x] . "</th>";
			$tamdiv = $tamdiv + strlen($RET[$x]);			
		}
	}

	if($OPCAO == ocultar_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			$tamdiv = $tamdiv + strlen($RET[$x]);			
		}
	}
	
	mysqli_close($conn);	

	if($mosdiv == tam_div){
		return $tamdiv;

	}else
	{
		return $RET;
	}
}

function Selecionar_Campos($lservername,$lusername,$lpassword,$ldbname,$TABLE,$OPCAO,$mosdiv){
	$tamdiv = 0;
	$temptamdiv = 0;


	// INICIO MYSQL
	
	$servername = $lservername;
	$username = $lusername;
	$password = $lpassword;
	$dbname = $ldbname;
	
	$NomeCampo = Listar_Campos($servername,$username,
$password,$dbname,$TABLE,ocultar_campo,retu_ret);
	$QtdCampo = count($NomeCampo);

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "select * from $TABLE";
	$res = $conn->query($sql);	
	
	$x = 0;
	$y = 0;
		
	while ($row = $res->fetch_assoc()) {
		if($OPCAO == testando){
			while($y < $QtdCampo){
	    			echo $row["$NomeCampo[$y]"];
					$temptamdiv = $temptamdiv + strlen($row["$NomeCampo[$y]"]);
					if($tamdiv < $temptamdiv){
						$tamdiv = $temptamdiv;
					}	
				$y++;
			}
			$y = 0;
			$temptamdiv = 0;
		}

		if($OPCAO == tabelando){
			echo "<tr>";
			while($y < $QtdCampo){
	    			echo utf8_encode("<td>" . $row["$NomeCampo[$y]"] . "</td>");
					$temptamdiv = $temptamdiv + strlen($row["$NomeCampo[$y]"]);
					if($tamdiv < $temptamdiv){
						$tamdiv = $temptamdiv;
					}	
				$y++;
			}
			$y = 0;
			$temptamdiv = 0;
			echo "</tr>";
		}
		
		if($OPCAO == ocultar_campo){
		
			while($y < $QtdCampo){				
				$temptamdiv = $temptamdiv + strlen($row["$NomeCampo[$y]"]);
				if($tamdiv < $temptamdiv){
					$tamdiv = $temptamdiv;
				}	
				$y++;
			}
			$y = 0;
			$temptamdiv = 0;
		}
		
	}
	
	mysqli_close($conn);	
	if($mosdiv == tam_div){
		return $tamdiv;
	}

	//return $RET;
}
?>


