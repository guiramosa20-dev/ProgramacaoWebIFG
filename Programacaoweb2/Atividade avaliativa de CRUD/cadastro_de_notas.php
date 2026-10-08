<?php
 if (isset($_POST['btn'])){
    $_id_disciplina = $_POST['id_disciplina'];
    $_id_aluno = $_POST['id_aluno'];
    $_bimestre = $_POST['bimestre'];
    $_nota = $_POST['nota'];
    
    require 'conexao.php';
    $pstmt = $conexao->prepare('insert into notas (aluno_id, disciplina_id, nota) values (:a, :d, :n)');
    $pstmt->bindvalue(':a', $_id_aluno);
    $pstmt->bindvalue(':d', $_id_disciplina);
    $pstmt->bindvalue(':n', $_nota);
    $pstmt->execute();
    

    $puxar_medias = $conexao-> prepare('select * from medias where aluno_id = :a and disciplina_id = :d');
    $puxar_medias->bindvalue(':a', $_id_aluno);
    $puxar_medias->bindvalue(':d', $_id_disciplina);
    $puxar_medias->execute();
    $medias = $puxar_medias->fetchAll(PDO::FETCH_ASSOC);
    if (count($medias) == 0){
        $adicionar_media = $conexao->prepare('insert into medias (aluno_id, disciplina_id, media, bimestre) values (:a, :d, (select avg(nota) from notas where aluno_id = :a and disciplina_id = :d), :b)');
        $adicionar_media->bindvalue(':a', $_id_aluno);
        $adicionar_media->bindvalue(':d', $_id_disciplina);
        $adicionar_media->bindvalue(':b', $_bimestre);
        $adicionar_media->execute();
    }
    else {
    $atualizar_media = $conexao->prepare('update medias set media = (select avg(nota) from notas where aluno_id = :a and disciplina_id = :d) where aluno_id = :a and disciplina_id = :d');
    $atualizar_media->bindvalue(':a', $_id_aluno);
    $atualizar_media->bindvalue(':d', $_id_disciplina);
    $atualizar_media->execute();
 }
 echo "<script>alert('Nota cadastrada com sucesso!');</script>";
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Notas</title>
</head>
<body>
    <fieldset>
        <legend>CADASTRO</legend>
        <form action="" method="post">
            <label for="disciplina">Disciplina</label>
            <select name="id_disciplina" id="id_disciplina">
                <option value="" selected hidden>Selecione uma disciplina</option>
                <?php
                    require 'conexao.php';
                    $pstmt = $conexao->prepare('select * from disciplinas');
                    $pstmt->execute();
                    $disciplinas = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($disciplinas as $disciplina) {
                        echo "<option value='{$disciplina['id']}'>{$disciplina['nome']}</option>";
                    }
                ?>
            </select>
            <label for="bimestre">bimestre</bimenstre>
            <input type="number" name="bimestre" id="bimestre" min="1" max="20">
            <label for="aluno">Aluno</label>
            <select name="id_aluno" id="id_aluno">
                <option value="" selected hidden>Selecione um aluno</option>
                <?php
                    $pstmt = $conexao->prepare('select * from alunos');
                    $pstmt->execute();
                    $alunos = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($alunos as $aluno) {
                        echo "<option value='{$aluno['cod']}'>{$aluno['nome']}</option>";
                    }
                ?>
            </select>
            <label for="nota">Nota</label>
            <input type="number" name="nota" id="nota" min="0" max="10" step="0.1">
            <input type="submit" value="Cadastrar" name="btn">
        </form>
    </fieldset>
</body>
</html>