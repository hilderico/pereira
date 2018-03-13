<html>
<head>
</head>
<body>
<?php

	ini_set('display_errors',1);
	include 'myfunc.php';
	$servername = htmlspecialchars($_POST['servername']);
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$dbname = htmlspecialchars($_POST['dbname']);
	$table = htmlspecialchars($_POST['table']);

	$tamdiv1 = Listar_Campos($servername,$username,$password,$dbname,$table,ocultar_campo,tam_div) * 15;
	$tamdiv2 = Selecionar_Campos($servername,$username,$password,$dbname,$table,ocultar_campo,tam_div) * 15;
		
	if($tamdiv1 < $tamdiv2){
		$WID = $tamdiv2;
	}else
	if($tamdiv1 == $tamdiv2){
		$WID = $tamdiv2;
	}else
	{
		$WID = $tamdiv1;
	}

	$COL = Listar_Campos($servername,$username,$password,$dbname,$table,nulo,mostrar_return);
	$DIVIDE_COL = count($COL);
	$PX_PERDIV = ($WID / $DIVIDE_COL);

?>



	<div style="position: fixed; width: <?php echo $WID;?>px; height: 600px; background-color: #ff8800;">
		<div style="position: absolute; top: 0px; left: 0px; width: <?php echo $PX_PERDIV;?>; height: 20px; background-color: #ff0000; text-align: center; font-size: 15px;">
		<?php echo $COL[0];?>
		</div>
		<div style="position: absolute; top: 0px; left: <?php echo (0 + $PX_PERDIV);?>; width: <?php echo ($WID / $DIVIDE_COL);?>; height: 20px; background-color: #ffff00; text-align: center; font-size: 15px;">
		<?php echo $COL[1];?>
		</div>




		
	</div>
</body>
</html>
