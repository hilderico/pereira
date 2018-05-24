<?php


header('Content-Type: text/html; charset=utf-8');
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

define('nulo', '0');
define('mostrar_campo', '1');
define('ocultar_campo', '0');
define('titulo_campo', '2');
define('testando', '3');
define('tabelando', '4');
define('tam_div', '5');
define('retu_ret', '6');
define('div_titulo_campo', '7');
define('mostrar_return', '8');
define('div_tabelando', '9');

$globtamdiv;


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
	$ltamdiv = 0;
	$ltemptamdiv = 0;

	global $globtamdiv;


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
		$globtamdiv[$x] = $RET[$x];	
		$x++;
	}
	
	if($OPCAO == mostrar_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			echo "Field -> " . $RET[$x] . "<br>";
			$ltamdiv = $ltamdiv + strlen($RET[$x]);
		}
	}
	if($OPCAO == titulo_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			echo "<th>" . $RET[$x] . "</th>";
			$ltamdiv = $ltamdiv + strlen($RET[$x]);			
		}
	}

	if($OPCAO == div_titulo_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			echo "<div>" . $RET[$x] . "</div>";
			$ltamdiv = $ltamdiv + strlen($RET[$x]);			
		}
	}

	if($OPCAO == ocultar_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			$ltamdiv = $ltamdiv + strlen($RET[$x]);			
		}
	}
	
	mysqli_close($conn);	

	if($mosdiv == tam_div){
		return $ltamdiv;
	}else
	if($mosdiv == mostrar_return){
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
$password,$dbname,$TABLE,ocultar_campo,mostrar_return);
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

		if($OPCAO == div_tabelando){			
			while($y < $QtdCampo){	    			
				$RET[$x][$y] = $row["$NomeCampo[$y]"];
					$temptamdiv = $temptamdiv + strlen($row["$NomeCampo[$y]"]);
					if($tamdiv < $temptamdiv){
						$tamdiv = $temptamdiv;
					}	
				$y++;
			}
			$y = 0;
			$x++;
			$temptamdiv = 0;			
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
	if($mosdiv == mostrar_return){
		return $RET;
	}
}

function Selecionar_Campos_a($lservername,$lusername,$lpassword,$ldbname,$TABLE,$OPCAO,$mosdiv){
	$tamdiv = 0;
	$temptamdiv = 0;
	
	global $globtamdiv;
	

	// INICIO MYSQL
	
	$servername = $lservername;
	$username = $lusername;
	$password = $lpassword;
	$dbname = $ldbname;
	
	$NomeCampo = Listar_Campos($servername,$username,
$password,$dbname,$TABLE,ocultar_campo,mostrar_return);
	$QtdCampo = count($NomeCampo);
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	$x = 0;
	$y = 0;

	while($y < $QtdCampo){
		$sql = "select * from $TABLE";
		$res = $conn->query($sql);
		while ($row = $res->fetch_assoc()) {
			if($OPCAO == testando){
				//echo $row["$NomeCampo[$y]"];
				$RET[$y][0] = $row["$NomeCampo[$y]"];

				$temptamdiv = strlen($row["$NomeCampo[$y]"]);
//				echo "*** DEBUG *** <br> function Selecionar_Campos_a <br> while(y < QtdCampo) <br>
//globtamdiv[$y] = $globtamdiv[$y] <br> strlen(globtamdiv[$y]) = " .strlen($globtamdiv[$y]) ."<br>tamdiv = $tamdiv<br> 
//temptamdiv = $temptamdiv <br>"; 

				if(strlen($globtamdiv[$y]) >= $tamdiv){
					$tamdiv = strlen($globtamdiv[$y]);
					$RET[$y][1]	= $tamdiv;
				}
				
				if($tamdiv <= $temptamdiv){
					$tamdiv = $temptamdiv;
					$RET[$y][1]	= $tamdiv;
				}					
				
			}	
		
		}
		$y++;
		$temptamdiv = 0;
		$tamdiv = 0;
	}
			
		
	
	
	mysqli_close($conn);	
	if($mosdiv == tam_div){
		$y = 0;
		while($y < $QtdCampo){
			$tamdiv += $RET[$y][1];
			$y++;
		}		
		return $tamdiv;
	}
	if($mosdiv == mostrar_return){
		return $RET;
	}
	
}

?>


