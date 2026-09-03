<?php
    require 'conexao.php';
    $id = $_GET['id'];
    $nome = $_GET['nome'];

    $excluir = $conexao->prepare("delete from alunos where cod = '$id'");
    $excluir->execute();
    echo "<h1>$nome excluido com sucesso</h1>";
    echo "<h4><a href='cadastro_alunos.php'>Clique aqui para voltar</a></h4>"
?>