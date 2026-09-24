<?php
    try {
        $conexao = new PDO('mysql: host=localhost; dbname=ti2026', 'root', '');
    } catch (Exception $erro) {
        echo $erro->getMessage();
        echo "<br>";
        echo $erro->getCode();
    }
?>