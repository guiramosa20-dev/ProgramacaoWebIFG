<?php
if (isset($_POST['btn'])){
    $_id_disciplina = $_POST['id_disciplina'];
    $_id_cursos = $_POST['id_cursos'];

    require 'conexao.php';
    $pstmt = $conexao->prepare('insert into disciplina_curso (curso_id, disciplina_id) values (:id_cursos, :id_disciplina)');
    $pstmt->bindvalue(':id_cursos', $_id_cursos);
    $pstmt->bindvalue(':id_disciplina', $_id_disciplina);
    $pstmt->execute();
    echo "Disciplina vinculada com sucesso!<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de disciplina a um curso</title>
</head>
<body>
    <fieldset>
        <legend>Cadastro de disciplina a um curso</legend>
        <form action="" method="post">
            <label for="id_disciplina">Disciplina:</label>
            <select name="id_disciplina" id="id_disciplina">
                <?php
                    require 'conexao.php';
                    $pstmt = $conexao->prepare('select * from disciplinas');
                    $pstmt->execute();
                    $disciplinas = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($disciplinas as $disciplina) {
                        echo "<option value='{$disciplina['id']}'>{$disciplina['nome']}</option>";
                    }
                ?>
            </select>
            <label for="id_cursos">Curso:</label>
            <select name="id_cursos" id="id_cursos">
                <?php
                    $pstmt = $conexao->prepare('select * from cursos');
                    $pstmt->execute();
                    $cursos = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($cursos as $curso) {
                        echo "<option value='{$curso['id']}'>{$curso['nome']}</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Cadastrar" name="btn">
        </form>
    </fieldset>
</body>
</html>

<?php
    require 'conexao.php';
    $listar = $conexao->prepare('select c.nome as curso, d.nome as disciplina from disciplina_curso dc inner join cursos c on dc.curso_id = c.id inner join disciplinas d on dc.disciplina_id = d.id');
    $listar->execute();
    $disciplinas_cursos = $listar->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'><tr><th>Disciplina</th>
        <th>Curso</th>
        </tr>";
    
    foreach($disciplinas_cursos as $dc){
        echo "<tr>
        <td> $dc[disciplina] </td>
        <td> $dc[curso] </td>
        </tr>";
    }
?>