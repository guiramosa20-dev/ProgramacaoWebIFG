<?php
    require 'conexao.php'; //chamada para a página de execussão
    if (isset($_POST['btn'])){
        $nome = $_POST['nome'];
        $cidade = $_POST['cidade'];
        $telefone = $_POST['telefone'];
        
        //cadastrando imagem
        $temp = $_FILES['selfie']['tmp_name'];
        $novoNome = uniqid().".jpg";
        move_uploaded_file($temp, "img/".$novoNome);

        //cadastrando no db
        $cad = $conexao->prepare("insert into alunos (nome, cidade, telefone, Imagem) values (:n , :c , :t, :i)");
        $cad->bindvalue(':n',$nome); //determinar os valores dos parâmetros
        $cad->bindvalue(':c',$cidade);
        $cad->bindvalue(':t',$telefone);
        $cad->bindvalue(':i',$novoNome);
        $cad->execute();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
<style>
    img{
        border-radius: 50%;
        background-position:center;
    }
</style>
</head>
<body>
    <fieldset>
        <legend>
            CADASTRO
        </legend>
        <form action="" method="POST" enctype="multipart/form-data">
        <p>
                <label for="nome">Foto:</label>
                <input type="file" name="selfie">
            </p>
            <p>
                <label for="nome">Nome:</label>
                <input type="text" name="nome">
            </p>
            <p>
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade">
            </p>
            <p>
                <label for="telefone">Telefone:</label>
                <input type="tel" name="telefone">
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
    $listar = $conexao->prepare("select * from alunos");
    $listar->execute();
    $x = $listar->fetchAll(PDO::FETCH_OBJ);

    echo "<table border='1'><tr><th>Imagem</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>cidade</th></tr>";
    foreach($x as $aluno){
        //mostrando os resultados e a opção de alterar e excluir
        echo " 
        <tr>
        <td><img src=img/$aluno->Imagem width=50px height=50px></td>
        <td>$aluno->nome</td>
        <td>$aluno->telefone</td>
        <td>$aluno->cidade</td>
        <td>
        <a href='alterar_alunos.php?id=$aluno->cod&nome=$aluno->nome&cidade=$aluno->cidade&tel=$aluno->telefone&img=$aluno->Imagem'
        onclick=\"return confirm('Tem certeza de que deseja alterar?');return false;\">[ALTERAR]</a> <br></td>
        <td><a href='excluir_alunos.php?id=$aluno->cod&nome=$aluno->nome'
        onclick=\"return confirm('Tem certeza de que deseja excluir?');return false;\">[EXCLUIR]</a> <br></td>
        </tr>";
        

        
    }
?>