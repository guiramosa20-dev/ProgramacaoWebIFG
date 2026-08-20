<?php
// file - fwrite - fopen -fclose

#criar e gravar um arquivo
$file = "texto.txt";
$arquivo = fopen($file,"a+");
fwrite($arquivo, "Se cheguei tão longe é porque subi no ombro de gigantes" . PHP_EOL);
fwrite($arquivo, "Isaac Newton" . PHP_EOL);
fwrite($arquivo, "Eu acho" . PHP_EOL);
fclose($arquivo);

#Leitura do arquivo
$abrir = file($file);
foreach($abrir as $linha) {
    echo "$linha <hr>";
}
?>