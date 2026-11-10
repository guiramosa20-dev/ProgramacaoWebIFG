<?php
require 'conexao.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Presença do Aluno</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Visualizar Presença do Aluno</h1>
    <fieldset>
        <legend>Selecione a disciplina para visualizar a presença:</legend>
        <form action="" method="post">
            <label for="disciplina">Disciplina:</label>
            <?php
                $pstmt = $conexao->prepare("SELECT * FROM disciplinas");
                $pstmt->execute();
                $disciplinas = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($disciplinas as $disciplina) {
                    echo "<input type='radio' name='disciplina' value='" . $disciplina['id'] . "'>" . $disciplina['nome'] . "<br>";
                }
            ?>
            <input type="submit" value="Visualizar Presença" name="btn">
        </form>
    </fieldset>

    <?php
        if (isset($_POST['btn'])) {
            $disciplina_id = $_POST['disciplina'];
            $aluno_id = $conexao->prepare("SELECT cod FROM alunos WHERE nome = :nome");
            $aluno_id->bindValue(':nome', $_SESSION['nome']);
            $aluno_id->execute();
            $aluno_id = $aluno_id->fetch(PDO::FETCH_ASSOC)['cod'];

            $pstmt = $conexao->prepare("SELECT * FROM presencas WHERE disciplinas_id = :d AND aluno_id = :a");
            $pstmt->bindValue(':d', $disciplina_id);
            $pstmt->bindValue(':a', $aluno_id);
            $pstmt->execute();
            $presencas = $pstmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($presencas) > 0) {
                echo "<h2>Presença na disciplina selecionada:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Data</th><th>Total faltas</th></tr>";
                foreach ($presencas as $presenca) {
                    echo "<tr><td>" . $presenca['dia'] . "</td><td>" . $presenca['comparecimento'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Nenhuma presença registrada para a disciplina selecionada.</p>";
            }
        }
        echo "<strong>Total de faltas:</strong> " . (isset($presencas) ? array_sum(array_column($presencas, 'comparecimento')) : 0);
        echo "<br><a href='home_aluno.php'>[Voltar]</a>";
    ?>
</body>
</html>