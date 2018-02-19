<?php


header('Content-Type: text/html; charset=utf-8');
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

define('mostrar_campo', '1');
define('ocultar_campo', '0');
define('titulo_campo', '2');
define('testando', '3');
define('tabelando', '4');


function Listar_Bases(){
	$servername = "mdierp.com.br";
	$username = "mdierpco_ilano";
	$password = "icf@chkdsk02#";


	$link = mysql_connect($servername, $username, $password);
	$res = mysql_query("SHOW DATABASES");

	while ($row = mysql_fetch_assoc($res)) {
    	echo $row["Database"] . "\n";
	}
	mysqli_close($link);
}

function Listar_Tabelas(){
	$servername = "mdierp.com.br";
	$username = "mdierpco_ilano";
	$password = "icf@chkdsk02#";
	$dbname = "mdierpco_nobre";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "show tables";
	$res = $conn->query($sql);

	while ($row = $res->fetch_assoc()) {
    	echo $row["Tables_in_mdierpco_nobre"] . "<br>";
	}	

	mysqli_close($conn);
}

function Listar_Campos($TABLE,$OPCAO){

	echo "<form action=\"action_page.php\" target=\"_blank\">";
	echo "	ServerName:<br>";
	echo "	<input type=\"text\" name=\"servername\" value=\"nome do servidor\"> <br>";
	echo "	UserName:<br>";
	echo "	<input type=\"text\" name=\"username\" value=\"nome do usuário\"> <br>";
	echo "	Password:<br>";
	echo "	<input type=\"text\" name=\"password\" value=\"Senha\"> <br>";
	echo "	DatabaseName:<br>";
	echo "	<input type=\"text\" name=\"dbname\" value=\"nome do servidor\"> <br>";
	echo "	<input type=\"submit\" value=\"Submit\"> <br>";
	echo "</form> <br>";

	
	$servername = "mdierp.com.br";
	$username = "mdierpco_ilano";
	$password = "icf@chkdsk02#";
	$dbname = "mdierpco_nobre";

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
    	//echo $row["Field"] . "<br>";
		$RET[$x] = $row["Field"];
		$x++;
	}
	
	if($OPCAO == mostrar_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			echo "Field -> " . $RET[$x] . "<br>";	
		}
	}
	if($OPCAO == titulo_campo){
		
		$Cont = count($RET);

		for($x = 0; $x < $Cont; $x++){
			echo "<th>" . $RET[$x] . "</th>";	
		}
	}
	
	mysqli_close($conn);	
	return $RET;
}

function Selecionar_Campos($TABLE,$OPCAO){
	
	$NomeCampo = Listar_Campos($TABLE,ocultar_campo);
	$QtdCampo = count($NomeCampo);
	
	
	// INICIO MYSQL
	
	$servername = "mdierp.com.br";
	$username = "mdierpco_ilano";
	$password = "icf@chkdsk02#";
	$dbname = "mdierpco_nobre";

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
				$y++;
			}
			$y = 0;
		}

		if($OPCAO == tabelando){
			echo "<tr>";
			while($y < $QtdCampo){
	    			echo utf8_encode("<td>" . $row["$NomeCampo[$y]"] . "</td>");
				$y++;
			}
			$y = 0;
			echo "</tr>";
		}
		
	}
	
	mysqli_close($conn);	
	//return $RET;
}
?>


