<?php
if (isset($_POST['btn'])){
    $nome = $_POST['nome'];
    $duracao = $_POST['duracao'];
    $anoCriacao = date('Y');

    require 'conexao.php';
    $pstmt = $conexao->prepare("insert into cursos (nome,duracao,ano) values (:n, :d, :y)");
    $pstmt->bindvalue(':n', $nome);
    $pstmt->bindvalue(':d', $duracao);
    $pstmt->bindvalue(':y', $anoCriacao);
    $pstmt->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cursos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <fieldset>
        <legend>
            CADASTRO
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>
                <label for="nome">Nome do curso:</label>
                <input type="text" name="nome" required>
            </p>
            <p>
                <label for="duracao">Duração (em semestres):</label>
                <input type="number" name="duracao" required>
            </p>
            <p>
                <input type="submit" value="Cadastrar" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>

<?php
session_start();
$_SESSION['logado'] = true;
    //listar no db
    require 'conexao.php';
    $listar = $conexao->prepare("select * from cursos");
    $listar->execute();
    $x = $listar->fetchAll(PDO::FETCH_OBJ);

    echo "<table border='1'><tr><th>Nome</th>
        <th>Duração</th>
        <th>Ano de criação</th>
        <th>Ações</th>
        </tr>";
    foreach($x as $curso){
        echo "<tr>
        <td> $curso->nome </td>
        <td> $curso->duracao </td>
        <td> $curso->ano </td>
        <td>
            <a href='alterar_curso.php?id=$curso->id&nome=$curso->nome&duracao=$curso->duracao'
            onclick=\"return confirm('Tem certeza de que deseja alterar?');return false;\">[ALTERAR]</a>
            <a href='excluir_curso.php?id=$curso->id&nome=$curso->nome'
            onclick=\"return confirm('Tem certeza de que deseja excluir?');return false;\">[EXCLUIR]</a>
        </td>
        </tr>";
    }
?>