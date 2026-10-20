<?php
require 'conexao.php';
$aluno = $_GET['id'];
$nome_aluno = $_GET['nome'];
        
$pstmt = $conexao->prepare("select n.nota, d.nome as disciplina from notas n inner join disciplinas d on n.disciplina_id = d.id where n.aluno_id = :a order by d.nome");
$pstmt->bindvalue(':a', $aluno);
$pstmt->execute();
$n = $pstmt->fetchAll(PDO::FETCH_OBJ);
echo "<link rel='stylesheet' href='estilo.css'>";
echo "<h2>Relatório de notas do aluno(a): $nome_aluno</h2>
        <h3>Disciplina: {$_GET['disciplina']}</h3>
        ";

echo "<table border='1'><tr>
        <th>Disciplina</th>
        <th>Nota</th>
        </tr>";
foreach($n as $notas){
    echo "<tr>
    <td> $notas->disciplina</td>
    <td> $notas->nota</td>
    </tr>";
}
echo "<a href='cadastro_de_notas.php'>[Voltar para cadastro de nota]</a>";
?>