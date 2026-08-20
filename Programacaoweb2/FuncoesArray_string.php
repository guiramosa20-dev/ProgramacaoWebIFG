<?php
    //funções específicas de array

    $x = array(10, 20, 30, 80, 50, 90);
    $ar1 = array("Flamengo", "Palmeiras", "Goiás");
    $ar2[0] = "Corinthians";
    $ar2[1] = "Cruzeiro";
    $u = 2;
    //is_array($variavelArray)
    if (is_array($u)){
        echo "É um array";
    } else{
        echo "Não é um array";
    }

    echo "<hr>";

    //in_array(valor, array)
   if (in_array(20,$x)) {
       echo "O valor existe";
    } else{
        echo "O valor NÃO existe";
    }
    echo "<hr>";
    var_dump(array_merge($ar1,$ar2));

    echo "<hr>";
    //array_shift(array) -> exclui e mostra o primeiro valor do array
    print_r(array_shift($ar2));
    echo "<hr>";

    //adição de valores no início do array
    //array_unshift(array, valor1, ..., valorN)
    array_unshift($ar1,"Fluminense","Vasco");
    print_r($ar1);
    echo "<hr>";

    //adição no final do array
    //array_push(array, valor1, ..., valorN)
    array_push($ar1, "Ceará","Bahia");
    print_r($ar1);
    echo "<hr>";

    //soma de valores de um array
    //array_sum(array($x))
    print_r(array_sum($x));
    echo "<hr>";

    //quantidade de registros e, um array
    //count(array)
    print_r(count($x));
    echo "<hr>";

    //transformar uma string em um array
    //explode("delimitador", string);
    $ex = explode("/","eu/tu/ele/nós");
    print_r($ex);
    echo "<hr>";

    //transforma array em string
    //implode("separador", array)
    $implode = implode(", ", $ar1);
    echo $implode;
    echo "<hr>";

    ######################Funções dates########################
    date_default_timezone_set('America/Sao_Paulo');
    $dia = date("d");
    $mes = date("m");
    $ano4 = date("Y");
    $ano2 = date("y");

    $hora24 = date("H");
    $hora12 = date("h");
    $minuto = date("i");
    $segundo = date("s");

    echo "Dia: $dia <br>";
    echo "Mês: $mes <br>";
    echo "Ano: $ano4 <br>";
    echo "Ano: $ano2 <br>";
    echo "Hora: $hora24 <br>";
    echo "Hora: $hora12 <br>";
    echo "Minuto: $minuto <br>";
    echo "Segundo: $segundo <br>";

    echo date("H:m:s");
    echo "<hr>";
    echo date("d/m/Y");
    echo "<hr>";
    echo date("d/m/Y H:i:s");

    date_default_timezone_set('America/Sao_Paulo');
    echo "<hr>";
    echo "Atividade!<br>";
    switch($mes){
        case 1:
            $string = "Janeiro";
            break;
        case 2:
            $string = "Fevereiro";
            break;
        case 3:
            $string = "Março";
            break;
        case 4:
            $string = "Abril";
            break;
        case 5:
            $string = "Maio";
            break;
        case 6:
            $string = "Junho";
            break;
        case 7:
            $string = "Julho";
            break;
        case 8:
            $string = "Agosto";
            break;
        case 9:
            $string = "setembro";
            break;
        case 10:
            $string = "Outubro";
            break;
        case 11:
            $string = "Novembro";
            break;
        case 12:
            $string = "Dezembro";
            break;
        default:
            $string = "Não existe";
    }
    echo "$dia de $string de $ano4";
?>