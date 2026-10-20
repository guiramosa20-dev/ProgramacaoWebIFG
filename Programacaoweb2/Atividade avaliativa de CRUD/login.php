<?php
session_start();
if (isset($_POST['btn'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    require 'conexao.php';
    $pstmt = $conexao->prepare('select * from usuarios where usuario = :u');
    $pstmt->bindValue(':u', $usuario);
    $pstmt->execute();
    $resultado = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($pstmt->rowCount() > 0){
            $senha_db = $resultado['senha'];
            if (password_verify($senha, $senha_db)){
                $_SESSION['logou'] = true;
                $_SESSION['nome'] = $resultado['usuario'];
                header("location: home.php");
                exit;
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <fieldset>
        <legend>LOGIN</legend>
        <form action="" method="post">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" required>
            <br><br>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>
            <br><br>
            <input type="submit" value="Entrar" name="btn">
        </form>
    </fieldset>
</body>
</html>