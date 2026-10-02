<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    require 'conexao.php';
    $id = $_GET['id'];
    $nome = $_GET['nome'];

    $excluir = $conexao->prepare("delete from alunos where cod = '$id'");
    $excluir->execute();
    echo "<h1>$nome excluido com sucesso</h1>";
    echo "<h4><a href='cadastro_alunos.php'>[Voltar p/ o cadastro]</a></h4><br>";
    echo "<a href='home.php'>[Voltar p/ home]</a>";
} else{
    header("Location: cadastro_alunos.php");
}
?>