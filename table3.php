<?php

ini_set('display_errors',1);

function existe($arq){
	$locresp = fopen($arq,"r");

	if($locresp == ""){
		echo "Arquivo não existe, mas será criado <br>";
		$locresp = fopen($arquivo,"w");
		fwrite($locresp,"0", 26);
		fclose($locresp); 
		return 0;
	}
	else{
		//echo "Arquivo existe<br>";
		fclose($locresp); 
		return 1;
	}
}


existe("dados/ncol.txt");
$arq = fopen("dados/ncol.txt","r");
$ncol = fgets($arq, 26);
fclose($arq);

existe("dados/nidx.txt");
$arq = fopen("dados/nidx.txt","r");
$nidx = fgets($arq, 26);
fclose($arq);

existe("dados/tam.txt");
$arq = fopen("dados/tam.txt","r");
$tam = fgets($arq, 26);
fclose($arq);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
global $ncol, $nidx, $tam;
$col[$nidx] = $_POST["fcol"];
$arq = fopen("dados/coluna_$nidx.txt","w");
fwrite($arq,$col[$nidx], 26);
fclose($arq);

$tam = $tam + strlen($col[$nidx]);
$arq = fopen("dados/tam.txt","w");
fwrite($arq,$tam, 26);
fclose($arq);

//echo "tamanho de \$col = " .$tam ."<br>";
//echo "nome de \$col" .$nidx ." = " .$col[$nidx];
$ncol = $ncol + 1;
$arq = fopen("dados/ncol.txt","w");
fwrite($arq,$ncol, 26);
fclose($arq);

$nidx = $nidx + 1;
$arq = fopen("dados/nidx.txt","w");
fwrite($arq,$nidx, 26);
fclose($arq);
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
CAMPO: <input type="text" name="fcol">
<input type="submit" name="submit" value="Submit"> 
</form>





