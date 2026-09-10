<?php
    require 'conexao.php'; //chamada para a página de execussão
    //dados gerais
    if (isset($_POST['btn'])){
        $nome = $_POST['nome'];
        $usuario = $_POST['user'];
        
        //senha
        if ($_POST['senha'] == $_POST['senha2']){
            $senha = $_POST['senha'];
            $cripto = password_hash($senha, PASSWORD_DEFAULT);
        }
        //data
        date_default_timezone_set('America/Sao_Paulo');
        $dataCriacao = date('Y-m-d');

        //cadastrando na database
        $cad = $conexao->prepare("insert into usuarios (nome, usuario, senha, dia) values(:n, :u, :s, :d)");
        $cad->bindvalue(':n',$nome);
        $cad->bindvalue(':u',$usuario);
        $cad->bindvalue(':s',$cripto);
        $cad->bindvalue(':d',$dataCriacao);
        $cad->execute();
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
<style>
    img{
        border-radius: 50%;
        background-position:center;
    }
</style>
</head>
<body>
    <fieldset>
        <legend>
            CADASTRO
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>
                <label for="nome">Nome:</label>
                <input type="text" name="nome">
            </p>
            <p>
                <label for="user">Usuario:</label>
                <input type="text" name="user">
            </p>
            <p>
                <label for="senha">Senha:</label>
                <input type="password" name="senha">
            </p>
            <p>
                <label for="senha2">Confirme a senha:</label>
                <input type="password" name="senha2">
            </p>
            <p>
                <input type="submit" value="Cadastrar" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>