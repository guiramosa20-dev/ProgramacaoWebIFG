<?php
session_start();
if (isset($_SESSION['logado'])){


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Está logado</title>
</head>
<body>
    <h1>está logado!</h1>
    <a href='sair_usuario.php'>[SAIR]</a>
</body>
</html>
<?php
    }else{
        header("location: login_usuario.php");
    }
?>