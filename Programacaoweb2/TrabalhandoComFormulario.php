<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form php</title>
</head>
<body>
    <form action="" method=GET>
        <fieldset>
            <legend>mês de nascimento</legend>
            <p>
                <label for="n1">Digite seu nome</label>
                <input type="text" name="n1">
            </p>
            <p>
                <label for="n2">Digite um número</label>
                <input type="text" name="n2">
            </p>
            <p>
                <input type="submit" value="cadastrar" name="btn">
            </p>
        </fieldset>
    </form>
    <?php
        if (isset($_GET['btn'])){
            $nome = $_GET['n1'];
            $numero = $_GET['n2'];
            switch ($numero){
                case 1:
                    $mes = "Janeiro";
                    break;
                case 2:
                    $mes = "Fevereiro";
                    break;
                case 3:
                    $mes = "Março";
                    break;
                case 4:
                    $mes = "Abril";
                    break;
                case 5:
                    $mes = "Maio";
                    break;
                case 6:
                    $mes = "Junho";
                    break;
                case 7:
                    $mes = "Julho";
                    break;
                case 8:
                    $mes = "Agosto";
                    break;
                case 9:
                    $mes = "setembro";
                    break;
                case 10:
                    $mes = "Outubro";
                    break;
                case 11:
                    $mes = "Novembro";
                    break;
                case 12:
                    $mes = "Dezembro";
                    break;
                default:
                    $mes = "Não existe";
            }

            echo "Você se chama $nome e nasceu em $mes.";
        }
    ?>
</body>
</html>