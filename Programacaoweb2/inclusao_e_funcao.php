<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inclusões e métodos</title>
</head>
<body>
    <?php
        function topo(){
            echo "<h1>Cabeçalho do site </h1>";
            echo "<h3>Programação Web 2 </h3> <hr>";
        }
        function soma($n1,$n2){
            $soma = $n1 +$n2;
            echo "<h2>A soma é: $soma";
        }
        topo();
        soma(2,2);
        soma(6,9);
    ?>
</body>
</html>
