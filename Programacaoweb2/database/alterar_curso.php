<?php
if(isset($_POST['btn'])){
    $id = $_POST['id'];
    $novoNome = $_POST['nome'];
    $novaDuracao = $_POST['duracao'];

    require "conexao.php";
    $pstmt = $conexao('update cursos set nome = :n, duracao = :d where id = :i');
    $pstmt->bindvalue(':i', $id);
    $pstmt->bindvalue(':n', $novoNome);
    $pstmt->bindvalue(':d', $novaDuracao);
    $pstnt->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cursos</title>
</head>
<body>
    <fieldset>
        <legend>
            ALTERAÇÃO
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="id" value="<?php echo $_GET['id']?>" readonly hidden>
            <p>
                <label for="nome">Novo nome:</label>
                <input type="text" name="nome" value="<?php echo $_GET['nome']?>">
            </p>
            <p>
                <label for="duracao">Nova quantidade de semestres:</label>
                <input type="number" name="duracao" value="<?php echo $_GET['duracao']?>">
            </p>
            <p>
                <input type="submit" value="Cadastrar" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>