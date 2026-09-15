<?php
    session_start();
    require "conexao.php";
    if (isset($_POST['btn'])){
        $usuario = $_POST['user'];
        $senha = $_POST['senha'];
        $buscar = $conexao->prepare("select * from usuarios where usuario = '$usuario'");
        $buscar->execute();

        if ($buscar->rowCount() > 0){
            $dados = $buscar->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $dados['senha'])){
                $_SESSION['logado'] = true;
                $_SESSION['nome'] = $dados['usuario'];
                header("location: home2.php");
            }else{
                echo "Senha incorreta!";
            }

        }
        else{
            echo "Usuário não encontrado!";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <fieldset>
        <legend>Formulário de Login</legend>
        <form action="" method="post">
            <p>
                <label for="user">Usuário</label><br>
                <input type="text" name="user">
            </p>
            <p>
                <label for="senha">Senha:</label><br>
                <input type="password" name="senha" required>
            </p>
            <p>
                <input type="submit" nome="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>
