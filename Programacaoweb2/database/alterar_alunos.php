<?php
require "conexao.php";
if(isset($_POST['btn'])){
    $cod = $_POST['id'];
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];
    
    $ald = $conexao->prepare("update alunos set nome=:n, cidade=:c, telefone=:t where cod = '$cod'");
    $ald->bindvalue(":n", $nome);
    $ald->bindvalue(":c", $cidade);
    $ald->bindvalue(":t", $telefone);
    $ald->execute();
    echo "<a href='cadastro_alunos.php'>[Voltar p/ o cadastro]</a>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar aluno</title>
</head>
<body>
<fieldset>
        <legend>
            ALTERAÇÃO
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>
                <input type="text" name="id" value="<?php echo $_GET['id']?>" readonly hidden>
            </p>
            <p>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo $_GET['nome']?>">
            </p>
            <p>
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" value="<?php echo $_GET['cidade']?>">
            </p>
            <p>
                <label for="telefone">Telefone:</label>
                <input type="tel" name="telefone" value="<?php echo $_GET['tel']?>">
            </p>
            <p>
                <input type="submit" value="Cadastrar" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>