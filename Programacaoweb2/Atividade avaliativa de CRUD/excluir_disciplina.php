<?php
     if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
        require 'conexao.php';
        $pstmt = $conexao->prepare('delete from disciplinas where id = :i');
        $pstmt->bindvalue(':i', $id);
        $pstmt->execute();
        echo "Disciplina excluída com sucesso!<br>";
        echo "<a href='cadastro_disciplina.php'>[Voltar p/ o cadastro] </a><br>";
        echo "<a href='home.php'>[Voltar p/ home]</a>";
    }
?>