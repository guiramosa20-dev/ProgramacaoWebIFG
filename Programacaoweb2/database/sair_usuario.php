<?php
    session_start();
    unset($_SESSION['logado']);
    session_destroy();
    header('location: login_usuario.php')
?>