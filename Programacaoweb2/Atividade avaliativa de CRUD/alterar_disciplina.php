<?php
 if (isset($_POST['btn'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $carga_horaria = $_POST['carga_horaria'];
    $ementa = $_POST['ementa'];
    $bibliografia = $_POST['bibliografia'];

    require 'conexao.php';
    $pstmt = $conexao->prepare("Update disciplinas set nome = :n, carga_horaria = :h, ementa = :e, bibliografia = :b where id = :i");
    $pstmt->bindvalue(":n", $nome);
    $pstmt->bindvalue(":h", $carga_horaria);
    $pstmt->bindvalue(":e", $ementa);
    $pstmt->bindvalue(":b", $bibliografia);
    $pstmt->bindvalue(":i", $id);
    $pstmt->execute();
    echo "Dados atualizados com sucesso!";
    echo "<a href='cadastro_disciplina.php'>[Voltar para cadastro de disciplinas] </a>";
    echo "<a href='home.php'>[Voltar para home]</a>";
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Disciplina</title>
    <style>
    /* Ajuste via CSS */
    .input-grande {
        width: 300px;
        height:10000px   /* largura fixa */
        padding: 8px;   /* espaço interno */
        font-size: 16px; /* tamanho do texto */
    }
    </style>
</head>
<body>
<fieldset>
        <legend>ALTERAÇÃO</legend>
        <form action="" method="post">
            <input type="number" name="id" value="<?php echo $_GET['id']?>" readonly hidden>
            <label for="nome">Nome da disciplina </label><br>
            <input type="text" name="nome" value="<?php echo $_GET['nome']?>" required><br>
            <lable for="carga_horaria">Carga horária </lable><br>
            <input type="number" name="carga_horaria" value="<?php echo $_GET['carga_horaria']?>" required><br>
            <label for="ementa">Ementa:</label><br>
            <input type="text" name="ementa" class="input-grande" value="<?php echo $_GET['ementa']?>" required><br>
            <label for="bibliografia">bibliografia</label><br>
            <input type="text" name="bibliografia" class="input-grande" value="<?php echo $_GET['bibliografia']?>" required><br>
            <input type="submit" value="Cadastrar" name="btn">
        </form>
    </fieldset>
</body>
</html>