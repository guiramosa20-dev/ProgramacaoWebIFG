<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Viajens</title>
</head>
<body>
    <fieldset>
        <legend>Formulario de cadastro de viagem:</legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>
                <label for="foto">selecione uma foto do destino:</label>
                <input type="file" name="foto">
            </p>
            <p>
                <label for="nome">Digite o nome do local:</label>
                <input type="text" name="nome">
            </p>
            <p>
                <input type="submit" value="Salvar registro de viajem" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>
<?php 
    if (isset($_POST['btn'])){
        $temp = $_FILES['foto']['tmp_name'];
        $novoNome = uniqid().".jpg";
        move_uploaded_file($temp, 'imgViagem/'.$novoNome);

        
        $file = "textoViagem.txt";

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("d/m/Y");
        $horario = date("H:i:s");

        $local = $_POST['nome']; 
        $arquivo = fopen($file, "a+");
        fwrite($arquivo, "$local;$novoNome;$data;$horario".PHP_EOL);
        fclose($arquivo);
        echo "<h1>$local cadastrado com sucesso!</h1>";
    }

    if (isset($file)){
        $abrir = file($file);
        foreach($abrir as $linhas){
            $info = explode(";", $linhas);
            echo "<img src=imgViagem/$info[1] width=100px> <br>";
            echo "Local: $info[0] <br>";
            echo "Data de cadastro: $info[2] <br>";
            echo "Horário de cadastro: $info[3] <br>";
            echo "<hr>";
        }
    }
?>