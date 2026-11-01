<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        require 'conexao.php';
        $pstmt = $conexao->prepare("delete from notas where id = :n");
        $pstmt->bindValue(':n', $id);
        $pstmt->execute();

        echo "<script>alert('Nota excluída com sucesso!'); window.location.href='cadastro_de_notas.php';</script>";
    } else {
        echo "<script>alert('ID da nota não fornecido.'); window.location.href='cadastro_de_notas.php';</script>";
    }

?>