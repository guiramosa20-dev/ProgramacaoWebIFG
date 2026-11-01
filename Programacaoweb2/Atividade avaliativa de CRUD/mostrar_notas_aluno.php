<?php
require 'conexao.php';
$aluno = $_GET['id'];
$nome_aluno = $_GET['nome'];
        
$pstmt = $conexao->prepare("select n.id, n.nota, d.nome as disciplina, a.nome as aluno from notas n inner join disciplinas d on n.disciplina_id = d.id inner join alunos a on n.aluno_id = a.cod where n.aluno_id = :a order by d.nome");
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
        <th>Ações</th>
        </tr>";
foreach($n as $notas){
    echo "<tr>
    <td> $notas->disciplina</td>
    <td> $notas->nota</td>
    <td><a href='editar_nota.php?id=$notas->id&aluno=$notas->aluno&nota=$notas->nota'>[Editar]</a> |
     <a href='excluir_nota.php?id=$notas->id'>[Excluir]</a></td>
    </tr>";
}
echo "<a href='cadastro_de_notas.php'>[Voltar para cadastro de nota]</a>";
?>