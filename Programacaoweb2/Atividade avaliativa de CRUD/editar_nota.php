<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $aluno = $_GET['aluno'];
        $nota = $_GET['nota'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='estilo.css'>
    <title>Editar Nota</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
        <label for="nova_nota">Alterar nota do aluno(a): <?php echo $aluno; ?></label>
        <input type="number" name="nova_nota" value="<?php echo $nota; ?>" step="0.1" min="0" max="10">
        <input type="submit" value="Atualizar" name='btn'>
    </form>
</body>
</html>

<?php
    if (isset($_POST['btn'])) {
        $id = $_POST['id'];
        $nova_nota = $_POST['nova_nota'];

        require 'conexao.php';
        $pstmt = $conexao->prepare("update notas set nota = :n where id = :i");
        $pstmt->bindValue(':n', $nova_nota);
        $pstmt->bindValue(':i', $id);
        $pstmt->execute();

        echo "<script>alert('Nota atualizada com sucesso!'); window.location.href='cadastro_de_notas.php';</script>";
    }