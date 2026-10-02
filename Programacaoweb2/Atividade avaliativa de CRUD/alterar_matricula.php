<?php
if (isset($_POST['btn'])){
    $id = $_POST['id'];
    $aluno = $_POST['aluno'];
    $curso = $_POST['curso'];

    require 'conexao.php';
    $get_aluno = $conexao->prepare("Select * from alunos where nome = :n");
    $get_aluno->bindvalue(":n", $aluno);
    $get_aluno->execute();
    $id_aluno = $get_aluno->fetch();

    $get_curso = $conexao->prepare("Select * from cursos where nome = :n");
    $get_curso->bindvalue(":n", $curso);
    $get_curso->execute();
    $id_curso = $get_curso->fetch();

    $pstmt = $conexao->prepare("Update matriculas set aluno_id = :a, curso_id = :c where id = :i");
    $pstmt->bindvalue(":a", $id_aluno['cod']);
    $pstmt->bindvalue(":c", $id_curso['id']);
    $pstmt->bindvalue(":i", $id);
    $pstmt->execute();

    echo "Valores alterados com sucesso!";
    echo "<a href='cadastro_matricula.php'>[Voltar para cadastro de disciplinas]</a>";
    echo "<a href='home.php'>[Voltar para home]</a>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de matrícula</title>

    <style>
        img{
            border-radius: 50%;
        }
</style>
</head>
<body>
    <fieldset>
        <legend>
            ALTERAR DE MATRÍCULA
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
        <input type="number" name="id" value="<?php echo $_GET['id']?>" readonly hidden>
            <p>
                <label for="aluno">Nome do aluno:</label>
                <input type="text" name="aluno" value="<?php echo $_GET['aluno']?>">
            </p>
            <p>
                <label for="curso">Curso:</label>
                <input type="text" name="curso" value="<?php echo $_GET['curso']?>">
            </p>
            <p>
                <input type="submit" value="Cadastrar" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>