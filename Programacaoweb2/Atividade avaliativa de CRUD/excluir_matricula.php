<?php
    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
        require 'conexao.php';
        $pstmt = $conexao->prepare('delete from matriculas where id = :i');
        $pstmt->bindvalue(':i', $id);
        $pstmt->execute();
        echo "Matrícula do(a) aluno(a) " . $_GET['aluno'] . "  do curso " . $_GET['curso'] . " excluída com sucesso!<br>";
        echo "<a href='cadastro_matricula.php'>[Voltar p/ o cadastro]</a><br>";
        echo "<a href='home.php'>[Voltar p/ home]</a>";
    }
?>