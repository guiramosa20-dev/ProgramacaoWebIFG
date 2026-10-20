<?php
    require 'conexao.php';
    $id_disciplina = $_GET['id_disciplina'];
    $nome_disciplina = $_GET['disciplina'];

    $pstmt = $conexao->prepare("select n.nota, a.nome as aluno from notas n inner join alunos a on n.aluno_id = a.cod where n.disciplina_id = :d order by a.nome");
    $pstmt->bindvalue(':d', $id_disciplina);
    $pstmt->execute();
    $notas = $pstmt->fetchAll(PDO::FETCH_OBJ);

    echo "<link rel='stylesheet' href='estilo.css'>";
    echo "<h2>Relatório de notas da disciplina: $nome_disciplina</h2>";

    echo "<table border='1'><tr>
            <th>Aluno</th>
            <th>Nota</th>
            </tr>";
    
    foreach($notas as $nota){
        echo "<tr>
        <td> $nota->aluno</td>
        <td> $nota->nota</td>
        </tr>";
    }

    echo "<a href='cadastro_de_notas.php'>[Voltar para cadastro de nota]</a>";
?>