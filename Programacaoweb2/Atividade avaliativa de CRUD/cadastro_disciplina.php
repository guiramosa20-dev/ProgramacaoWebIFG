<?php
    if(isset($_POST['btn'])){
        $nome = $_POST['nome'];
        $carga_horaria = $_POST['carga_horaria'];
        $ementa = $_POST['ementa'];
        $bibliografia = $_POST['bibliografia'];

        require 'conexao.php';
        $pstmt = $conexao->prepare("insert into disciplinas (nome, carga_horaria, ementa, bibliografia) values (:n, :h, :e, :b)");
        $pstmt->bindvalue(":n", $nome);
        $pstmt->bindvalue(":h", $carga_horaria);
        $pstmt->bindvalue(":e", $ementa);
        $pstmt->bindvalue(":b", $bibliografia);
        $pstmt->execute();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de disciplinas</title>
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
        <legend>CADASTRO</legend>
        <form action="" method="post">
            <label for="nome">Nome da disciplina </label><br>
            <input type="text" name="nome" required><br>
            <lable for="carga_horaria">Carga horária </lable><br>
            <input type="number" name="carga_horaria" required><br>
            <label for="ementa">Ementa:</label><br>
            <input type="text" name="ementa" class="input-grande" required><br>
            <label for="bibliografia">bibliografia</label><br>
            <input type="text" name="bibliografia" class="input-grande" required><br>
            <input type="submit" value="Cadastrar" name="btn">
        </form>
    </fieldset>
</body>
</html>

<?php
    require 'conexao.php';
    $listar = $conexao->prepare("Select * from disciplinas");
    $listar->execute();
    $x = $listar->fetchAll(PDO::FETCH_OBJ);

    echo "<table border='1'>
        <th>Nome</th>
        <th>Carga Horária</th>
        <th>Ementa</th>
        <th>Bibliografia</th>
        <th>Ações</th></tr>";

    foreach($x as $disciplina){
       echo" <tr>
        <td>$disciplina->nome</td>
        <td>$disciplina->carga_horaria</td>
        <td>$disciplina->ementa</td>
        <td>$disciplina->bibliografia</td>
        <td>
        <a href='alterar_disciplina.php?id=$disciplina->id&nome=$disciplina->nome&carga_horaria=$disciplina->carga_horaria&ementa=$disciplina->ementa&bibliografia=$disciplina->bibliografia'
        onclick=\"return confirm('Tem certeza de que deseja alterar?');return false;\">[ALTERAR]</a> <br></td>
        <td><a href='excluir_disciplina.php?id=$disciplina->id&nome=$disciplina->nome'
        onclick=\"return confirm('Tem certeza de que deseja excluir?');return false;\">[EXCLUIR]</a> <br></td>
        </tr>";
    }
?>