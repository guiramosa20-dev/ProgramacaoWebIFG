<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Notas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form action="" method="post">
        <label for="disciplina">Disciplina:</label>
        <?php
            
            require 'conexao.php';
            $pstmt = $conexao->prepare("select * from disciplinas");
            $pstmt->execute();
            $disciplinas = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($disciplinas as $disciplina) {
                echo "<input type='radio' name='disciplina' value='" . $disciplina['id'] . "'>" . $disciplina['nome'] . "<br>";
            }
        ?>
        <input type="submit" value="Visualizar Notas" name="btn">
    </form>
    <?php
        require 'conexao.php';
        if(isset($_POST['btn'])) {
            $aluno = $conexao->prepare("select cod from alunos where nome = :nome");
            $aluno->bindvalue(':nome', $_SESSION['nome']);
            $aluno->execute();
            $aluno_id = $aluno->fetch(PDO::FETCH_ASSOC)['cod'];
            $disciplina = $_POST['disciplina'] ?? null;
            $pstmt = $conexao->prepare("select n.id, n.nota, d.nome as disciplina, a.nome as aluno from notas n inner join disciplinas d on n.disciplina_id = d.id inner join alunos a on n.aluno_id = a.cod where n.aluno_id = :a and n.disciplina_id = :d order by d.nome");
            $pstmt->bindvalue(':a', $aluno_id);
            $pstmt->bindvalue(':d', $disciplina);
            $pstmt->execute();
            $notas = $pstmt->fetchAll(PDO::FETCH_OBJ);
            echo "<link rel='stylesheet' href='estilo.css'>";
            echo "<h2>Relatório de notas da disciplina: {$disciplina}</h2>";

            echo "<table border='1'><tr>
                    <th>Disciplina</th>
                    <th>Nota</th>
                    </tr>";
            foreach($notas as $nota){
                echo "<tr>
                <td> $nota->disciplina</td>
                <td> $nota->nota</td>
                </tr>";
            }
            echo "</table>";

            echo "<hr>";
            $media = $conexao->prepare("select media from medias where aluno_id = :a and disciplina_id = :d");
            $media->bindvalue(':a', $aluno_id);
            $media->bindvalue(':d', $disciplina);
            $media->execute();
            $media = $media->fetch(PDO::FETCH_ASSOC)['media'] ?? 'N/A';
            echo "<h3>Média: $media</h3>";
        }
    ?>
    <a href='home_aluno.php'>[Voltar para o painel do aluno]</a>
</body>
</html>
