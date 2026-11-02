<?php
    if (isset($_POST['btn'])){
        require 'conexao.php';
        $data_php = $_POST['data'];
        $disciplina = $_POST['disciplinas'];
        $presencas = $_POST['presenca'] ?? [];
        //passsando a data para o formato do banco de dados
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d', strtotime($data_php));

        //selecionando todos os alunos para registrar a presença
        $pstmt = $conexao->prepare("select * from alunos");
        $pstmt->execute();
        $alunos = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        //insersão no banco de dados
        foreach ($alunos as $aluno){
            $presenca = $presencas[$aluno['cod']] ?? 0;
            $pstmt = $conexao->prepare("insert into presencas (aluno_id, comparecimento, dia, disciplinas_id) values (:cod_aluno, :presenca, :data, :cod_disciplina)");
            $pstmt->bindParam(':cod_aluno', $aluno['cod']);
            $pstmt->bindParam(':cod_disciplina', $disciplina);
            $pstmt->bindParam(':data', $data);
            $pstmt->bindParam(':presenca', $presenca);
            $pstmt->execute();
        }
    }
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
            <h3>Lista de alunos</h3>
            <?php
                require 'conexao.php';
                $pstmt = $conexao->prepare("select * from alunos");
                $pstmt->execute();
                $alunos = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($alunos as $aluno){
                    echo "<label for='presenca[{$aluno['cod']}]'>{$aluno['nome']}: </label>
                    <input type='number' min='0' max='2' name='presenca[{$aluno['cod']}]' size='1' maxlength='1' placeholder='Selecione um número de 0 a 2 para marcar a presença do aluno nessa data' required>
                    <br>";
                }
            ?>

            <label for="data"><h3>Selecione a data:</h3></label>
            <input type="date" name="data" required>
            <br><br>
            <input type="submit" value="Registrar Presença" name="btn">
        </form>
    </legend>
</body>
</html>