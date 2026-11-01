<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de presença</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <legend>
        <form action="" method="post">
            <label for="disciplinas"><h3>Selecione disciplina:</h3></label>
            <?php
                require 'conexao.php';
                $pstmt = $conexao->prepare("select * from disciplinas");
                $pstmt->execute();
                $disciplinas = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($disciplinas as $disciplina){
                    echo "<input type='radio' name='disciplinas' value='{$disciplina['id']}'>{$disciplina['nome']}<br>";
                }
            ?>
            <hr>
            <label for ="alunos"><h3>Lista de alunos</h3></label>
            <?php
                require 'conexao.php';
                $pstmt = $conexao->prepare("select * from alunos");
                $pstmt->execute();
                $alunos = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($alunos as $aluno){
                    echo "{$aluno['nome']}: 
                    <input type='number' min='0' max='2' name='presenca {$aluno['cod']}' size='1' placeholder='Selecione um número de 0 a 2 para marcar a presença do aluno nessa data' required>
                    <br>";
                }
            ?>

            <label for="data"><h3>Selecione a data:</h3></label>
            <input type="date" name="data" required>
            <br><br>
            <input type="submit" value="Registrar Presença">
        </form>
    </legend>
</body>
</html>