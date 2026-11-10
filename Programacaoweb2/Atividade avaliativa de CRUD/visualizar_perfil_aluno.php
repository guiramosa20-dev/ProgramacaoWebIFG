<?php
    require 'conexao.php';
    session_start();
    
    $pstmt = $conexao->prepare("select * from alunos where nome = :nome");
    $pstmt->bindvalue(':nome', $_SESSION['nome']);
    $pstmt->execute();
    $aluno = $pstmt->fetch(PDO::FETCH_ASSOC);

    $pstmt = $conexao->prepare("select m.curso_id, c.nome as curso_nome from matriculas m join cursos c on m.curso_id = c.id where m.aluno_id = :aluno_id");
    $pstmt->bindvalue(':aluno_id', $aluno['cod']);
    $pstmt->execute();
    $matricula = $pstmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        fieldset {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <fieldset>
        <h1>Perfil do Aluno</h1>
        <img src="img/<?php echo $aluno['Imagem']; ?>" alt="Foto do Aluno" width="200" height="200" border-radius="50px">
        <p><strong>Nome:</strong> <?php echo $aluno['nome']; ?></p>
        <p><strong>Telefone:</strong> <?php echo $aluno['telefone']; ?></p>
        <p><strong>Cidade:</strong> <?php echo $aluno['cidade']; ?></p>
        <p><strong>Curso:</strong> <?php echo $matricula['curso_nome']; ?></p>
    <a href="home_aluno.php">[Voltar]</a>
    </fieldset>

</body>
</html>