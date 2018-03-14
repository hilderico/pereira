<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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

	$tampixl = 15;

	$tamdiv1 = Listar_Campos($servername,$username,$password,$dbname,$table,ocultar_campo,tam_div) * $tampixl;
	$tamdiv2 = Selecionar_Campos($servername,$username,$password,$dbname,$table,ocultar_campo,tam_div) * $tampixl;
		
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
	$TAM_PERCOL = Selecionar_Campos_a($servername,$username,$password,$dbname,$table,testando,mostrar_return);
	$REGS = Selecionar_Campos($servername,$username,$password,$dbname,$table,div_tabelando,mostrar_return);
$PASS_COL = 0;
$PASS_TOP = 0;
$PASS_LEFT = 0;
$PASS_REGS = 0;
$TOTAL_REGS = count($REGS);
$DIVCOLOR = array("#f2f2f2", "#ddd");



	
?>

	<div style="position: fixed; width: <?php if($WID > 800){	$WID = 800;	echo $WID; }else{	echo $WID + 5;}
?>px; height: 600px; overflow: auto; border-radius: 5px; margin: auto;">

<?php
		while($PASS_COL < $DIVIDE_COL){
			$LOCTAM_PERCOL = $TAM_PERCOL[$PASS_COL][1];			
			echo "<div style=\"position: absolute; top: ".$PASS_TOP ."px; left: " .$PASS_LEFT ."px; width: ".($LOCTAM_PERCOL * $tampixl)
."px; height: 20px; background-color: #6c7ae0; text-align: left; font-size: 15px; color: white;\">";
			echo utf8_encode($COL[$PASS_COL]);
			echo "</div>";
			$PASS_LEFT = $PASS_LEFT + ($LOCTAM_PERCOL * $tampixl);
			$PASS_COL++;
		}

		$PASS_COL = 0;
		$PASS_LEFT = 0;
		$PASS_TOP = $PASS_TOP + 20;		
		
		while($PASS_REGS < $TOTAL_REGS){
			while($PASS_COL < $DIVIDE_COL){
				echo "<div style=\"position: absolute; top: ".$PASS_TOP ."px; left: " .$PASS_LEFT ."px; width: ".($TAM_PERCOL[$PASS_COL][1] * $tampixl)
."px; height: 20px; background-color: " .$DIVCOLOR[$PASS_REGS % 2] ."; text-align: left; font-size: 15px;\">";
				echo utf8_encode($REGS[$PASS_REGS][$PASS_COL]);
				echo "</div>";
				$PASS_LEFT = $PASS_LEFT + ($TAM_PERCOL[$PASS_COL][1] * $tampixl);
				$PASS_COL++;
			}
			$PASS_COL = 0;
			$PASS_LEFT = 0;
			$PASS_TOP = $PASS_TOP + 20;
			$PASS_REGS++;
		}

?>		


		
	</div>


	
</body>
</html>
