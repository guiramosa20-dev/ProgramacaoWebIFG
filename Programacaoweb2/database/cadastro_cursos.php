<?php
//cadastro no db
    require 'conexao.php';
    if(isset($_POST['btn'])){
        $curso = $_POST['nome'];
        $duracao = $_POST['duracao'];
    }

    $cad = $conexao->prepare("insert into curso (nome, duracao) values (:n, :d)");
    $cad->bindvalue(':n',$curso);
    $cad->bindvalue(':d',$duracao);
    $cad->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cursos</title>
</head>
<body>
    <fieldset>
        <legend>
            CADASTRO
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>
                <label for="nome">Nome do curso:</label>
                <input type="text" name="nome">
            </p>
            <p>
                <label for="duracao">Duração (em semestres):</label>
                <input type="number" name="duracao">
            </p>
            <p>
                <input type="submit" value="Cadastrar" name="btn">
            </p>
        </form>
    </fieldset>
</body>
</html>
<?php
    //listar no db
    $listar = $conexao->prepare("select * from curso");
    $listar->execute();
    $x = $listar->fetchAll(PDO::FETCH_OBJ);
    foreach($x as $curso){
        echo "<b>Curso: </b> $curso->nome <br><b>Duração: </b> $curso->duracao <br><br><a href='alterar_cursos.php?id=$curso->cod&nome=$curso->nome&duracao=$curso->duracao'onclick=\"return confirm('Tem certeza de que deseja alterar?');return false;\">[ALTERAR]</a><br><hr>";
    }
?>