<?php
    require 'conexao.php';
    $pstmt = $conexao->prepare("select d.nome as disciplina, avg(n.nota) as media from notas n inner join disciplinas d on n.disciplina_id = d.id group by d.nome having avg(n.nota) < 6");
    $pstmt->execute();
    $disciplinas = $pstmt->fetchAll(PDO::FETCH_OBJ);
    echo "<link rel='stylesheet' href='estilo.css'>";
    echo "<h2>Disciplinas com média abaixo de 6</h2>";
    echo "<table border='1'><tr>
            <th>Disciplina</th>
            <th>Média</th>
            </tr>";
    foreach($disciplinas as $disciplina){
        if ($disciplina->media < 6) {
            echo "<tr>
            <td> $disciplina->disciplina</td>
            <td> $disciplina->media</td>
            </tr>";
        }
    }
    echo "<a href='cadastro_de_notas.php'>[Voltar para cadastro de nota]</a>";
?>