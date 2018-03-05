<?php

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

Listar_Tabelas();



?>
