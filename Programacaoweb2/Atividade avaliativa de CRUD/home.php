<?php
session_start();
if (isset($_SESSION['logou']) && $_SESSION['logou'] === true) {
    // Usuário está logado, exibir a página

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do ambiente virtual da Faculdade Javali Cansado</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Painel do ambiente virtual da Faculdade Javali Cansado!</h2>
    <h3>Bem-vindo(a), <?php echo $_SESSION['nome']; ?>!</h3>
    <h3>Escolha uma das funcionalidades abaixo:</h3>
    <ul>
        <li><a href="cadastro_alunos.php">Alunos</a></li>
        <li><a href="cadastrar_curso.php">Cursos</a></li>
        <li><a href="cadastro_matricula.php">Matrículas</a></li>
        <li><a href="cadastro_disciplina.php">Disciplinas</a></li>
        <li><a href="associa_disciplina_materia.php">Associação de disciplina a um curso</a></li>
        <li><a href="cadastro_de_notas.php">Cadastro de Notas</a></li>
        <li><a href="login.php">Trocar de usuário</a></li>
    </ul>
    <marquee behavior="scroll" direction="left" scrollamount="10">
        <p>Seja bem-vindo(a) ao ambiente virtual da Faculdade Javali Cansado! Aqui você pode gerenciar alunos, cursos, matrículas, disciplinas e notas de forma prática e eficiente. Aproveite todas as funcionalidades disponíveis e tenha uma experiência completa no gerenciamento acadêmico.</p>
    </marquee>
</body>
</html>

<?php
} else {
    // Usuário não está logado, redirecionar para a página de login
    header("Location: login.php");
    exit;
}
?>