<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora com o pior layout do mundo!</title>
</head>
<body>
    <fieldset>
        <legend>Calculadora com o pior layout do mundo!</legend>
        <form action="" method="get">
            <p>
            <label for="n1">Digite o primeiro número:</label>
            <input type="number" name="n1" id="n1" required>
            <br>
            </p>
            
            <p>
            <label for="operacao">Escolha a operação:</label>
            <select name="operacao" id="operacao" required>
                <option value="" disabled selected hidden>Selecione</option>
                <option value="soma">Soma</option>
                <option value="subtracao">Subtração</option>
                <option value="multiplicacao">Multiplicação</option>
                <option value="divisao">Divisão</option>
            </select>
            <br>
            </p>
            
            <p>
            <label for="n2">Digite o segundo número:</label>
            <input type="number" name="n2" id="n2" required>
            <br>
            </p>
            <p>
            <input type="submit" value="Calcular">
            </p>
        </form>
    </fieldset>
</body>
</html>

<?php
    if(isset($_GET['n1']) && isset($_GET['n2']) && isset($_GET['operacao'])){
        //inicializando as variáveis com valores recebidos do formulário e fazendo a operação escolhida
        $n1 = $_GET['n1'];
        $n2 = $_GET['n2'];
        $operacao = $_GET['operacao'];

        switch($operacao){
            case 'soma':
                $resultado = $n1 + $n2;
                break;
            case 'subtracao':
                $resultado = $n1 - $n2;
                break;
            case 'multiplicacao':
                $resultado = $n1 * $n2;
                break;
            case 'divisao':
                if($n2 != 0){
                    $resultado = $n1 / $n2;
                } else {
                    echo "Erro: Divisão por zero!";
                    exit;
                }
                break;
            default:
                echo "Operação inválida!";
                exit;
        }
        //output da operação atual na tela
        echo "<h2>O resultado da operação é: $resultado</h2>";

        //salvando resultado em um arquivo de texto
        $file = ("historico.txt");
        $historico = fopen($file, "a+");
        fwrite($historico, "$operacao;$n1;$n2;$resultado" . PHP_EOL);
        fclose($historico);

        //acessar historico e mostrar na tela
        echo "<h3>Histórico de operações:</h3>";
        $historico = file($file);
        foreach($historico as $linha){
            $info = explode(";", $linha);
            echo $info[1];
            switch($info[0]){
                case 'soma':
                    echo " + ";
                    break;
                case 'subtracao':
                    echo " - ";
                    break;
                case 'multiplicacao':
                    echo " * ";
                    break;
                case 'divisao':
                    echo " / ";
                    break;
            }
            echo $info[2] . " = " . $info[3];
            echo "<hr>";
        }
    }