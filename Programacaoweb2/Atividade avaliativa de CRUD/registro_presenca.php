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
        
    </fieldset>
    <fieldset>
        <legend>
        <form action="" method="post">
            <label for="disciplina">Selecione a disciplina para visualisar as notas</label>
            <?php
                foreach ($disciplinas as $disciplina){
                    echo "<input type='radio' name='disciplina' value='{$disciplina['id']}'>{$disciplina['nome']}<br>";
                }
            ?>
            <input type="submit" value="Visualisar" name="visualisar">
        </form>
        </legend>
    </fieldset>
    <?php
        if (isset($_POST['visualisar'])){
            $disciplina = $_POST['disciplina'];
            require 'conexao.php';
            $pstmt = $conexao->prepare("select p.*, a.nome as aluno from presencas p inner join alunos a on p.aluno_id = a.cod where disciplinas_id = :d order by dia");
            $pstmt->bindvalue(":d", $disciplina);
            $pstmt->execute();
            $presencas = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<table border='1'><tr><th>dia</th>
            <th>Aluno</th>
            <th>Comparecimento</th></tr>";
            foreach($presencas as $presenca){ 
                echo "<tr><td>{$presenca['dia']}</td>
                    <td>{$presenca['aluno']}</td>
                    <td>{$presenca['comparecimento']}</td></tr>";           
            }
            
            $contador = $conexao->prepare("Select count(distinct aluno_id) as total_alunos from presencas");
            $contador->execute();
            $total = $contador->fetch(PDO::FETCH_ASSOC);
            
            function contarFaltas($aluno, $presencas){
                $cont = 0;
                foreach($presencas as $presenca){
                    if ($presenca['aluno'] == $aluno){
                        $cont += $presenca['comparecimento'] ?? 2;
                    }
                }
                return $cont;
            }
            echo "<table border='1'><tr><th>Aluno</th><th>Total</th></tr>";
            for($i = 0; $i < $total['total_alunos']; $i++){
                echo "<tr><td>{$presencas[$i]['aluno']}</td><td>" . contarFaltas($presencas[$i]['aluno'], $presencas) . "</td></tr>";
            }
        }
    ?>
</body>
</html>