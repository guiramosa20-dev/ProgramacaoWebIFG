<?php
    session_start();
    if (isset($_SESSION['logou']) && $_SESSION['logou'] === true && isset($_SESSION['eh_aluno']) && $_SESSION['eh_aluno'] == true) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Aluno da Faculdade Javali Cansado</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Painel do Aluno da Faculdade Javali Cansado</h2>
    <h3>Bem-vindo(a), <?php echo $_SESSION['nome']; ?>!</h3>
    <h3>Escolha uma das funcionalidades abaixo:</h3>
    <ul>
        <li><a href="visualizar_perfil_aluno.php">Visualizar Perfil</a></li>
        <li><a href="visualizar_notas_aluno.php">Visualizar Notas</a></li>
        <li><a href="visualizar_presenca_aluno.php">Visualizar Presenças</a></li>
        <li><a href="login.php">Trocar de usuário</a></li>
    </ul>
</body>
</html>

<?php
    } else {
        // Usuário não está logado, redirecionar para a página de login
        header("Location: login.php");
        exit;
    }