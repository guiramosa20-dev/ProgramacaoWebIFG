<?php
    if (isset($_POST['btn'])){
        $aluno = $_POST['aluno'];
        $curso = $_POST['curso'];

        require 'conexao.php';

        //pegando dados de aluno
        $pstmt1 = $conexao->prepare('select cod from alunos where nome = :a');
        $pstmt1->bindvalue(':a', $aluno);
        $pstmt1->execute();
        $aluno_existe = $pstmt1->fetch(PDO::FETCH_OBJ);

        //pegando dados do curso
        $pstmt2 = $conexao->prepare('select id from cursos where nome = :c');
        $pstmt2->bindvalue(':c', $curso);
        $pstmt2->execute();
        $curso_existe = $pstmt2->fetch(PDO::FETCH_OBJ);

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        strtotime($data);
        try{
            $pstmt3 = $conexao->prepare('Insert into matriculas (aluno_id, curso_id, data_matricula) values (:a, :c, :d)');
            $pstmt3->bindvalue(':a', $aluno_existe->cod);
            $pstmt3->bindvalue(':c', $curso_existe->id);
            $pstmt3->bindvalue(':d', $data);
            $pstmt3->execute();

            echo "Cadastro feito!";
        } catch (PDOException $e){
            echo "Erro ao cadastrar: " . $e->getMessage();
    }
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
            CADASTRO DE MATRÍCULA
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>
                <label for="aluno">Nome do aluno:</label>
                <input type="text" name="aluno" required>
            </p>
            <p>
                <label for="curso">Curso:</label>
                <input type="text" name="curso" required>
            </p>
            <p>
                <input type="submit" value="Cadastrar" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>

<?php
    require 'conexao.php';
    $listar = $conexao->prepare("select m.id, a.nome as aluno_nome, a.Imagem, c.nome as curso_nome, m.data_matricula from matriculas m inner join alunos a on m.aluno_id = a.cod inner join cursos c on m.curso_id = c.id");
    $listar->execute();
    $x = $listar->fetchAll(PDO::FETCH_OBJ);

    echo "<table border='1'><tr><th>Imagem</th>
        <th>Aluno</th>
        <th>Curso</th>
        <th>Data da Matrícula</th>
        <th>Ações</th>
        </tr>";
    foreach($x as $matricula){
        echo "<tr><td><img src='img/$matricula->Imagem' width='50px' height='50px'></td><td>$matricula->aluno_nome</td><td>$matricula->curso_nome</td><td>$matricula->data_matricula</td>
        <td><a href='excluir_matricula.php?id=$matricula->id&aluno=$matricula->aluno_nome&curso=$matricula->curso_nome' onclick=\"return confirm('Tem certeza de que deseja excluir?');return false;\"> [EXCLUIR] </a> 
        <a href='alterar_matricula.php?id=$matricula->id&aluno=$matricula->aluno_nome&curso=$matricula->curso_nome' onclick=\"return confirm('Tem certeza de que deseja alterar?');return false;\"> [ALTERAR] </a></td>
        </tr>";
    }
?>