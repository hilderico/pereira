<?php

ini_set('display_errors',1);

function existe($arq){
$locresp = fopen($arq,"r");

if($locresp == ""){
echo "Arquivo não existe, mas será criado";
$locresp = fopen($arquivo,"w");
fwrite($locresp,"0", 26);
fclose($locresp); 
return 0;
}
else{
echo "Arquivo existe";
fclose($locresp); 
return 1;
}

}



existe("ncol.txt");
$arq = fopen("ncol.txt","r");
$ncol = fgets($arq, 26);
fclose($arq);

existe("nidx.txt");
$arq = fopen("nidx.txt","r");
$nidx = fgets($arq, 26);
fclose($arq);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
global $ncol, $nidx;
$col[$nidx] = $_POST["fcol"];
$tam = strlen($col[$nidx]);
echo "tamanho de \$col = " .$tam ."<br>";
echo "nome de \$col" .$nidx ." = " .$col[$nidx];
$ncol = $ncol + 1;
$arq = fopen("ncol.txt","w");
fwrite($arq,$ncol, 26);
fclose($arq);

$nidx = $nidx + 1;
$arq = fopen("nidx.txt","w");
fwrite($arq,$nidx, 26);
fclose($arq);
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
CAMPO: <input type="text" name="fcol">
<input type="submit" name="submit" value="Submit"> 
</form>
