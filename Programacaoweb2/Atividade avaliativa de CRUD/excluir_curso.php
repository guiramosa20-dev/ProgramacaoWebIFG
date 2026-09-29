<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $nome = $_GET['nome'];

    require "conexao.php";
    $pstmt = $conexao->prepare('delete from cursos where id = :i');
    $pstmt->bindvalue(':i', $id);
    $pstmt->execute();
    echo "<h3>Curso  de $nome excluído com sucesso!</h3>";
    echo "<a href='cadastrar_curso.php'>[Voltar p/ o cadastro]</a><br>";
    echo "<a href='home.php'>[Voltar p/ home]</a>";
}
?>