<?php
include('../includes/conexao.php');

function gerarCodigoLivro() {
    return uniqid("LIV");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = gerarCodigoLivro();
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $editora = $_POST['editora'];

    $stmt = $conexao->prepare("INSERT INTO livros (codigo, titulo, autor, categoria, editora) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $codigo, $titulo, $autor, $categoria, $editora);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao cadastrar o livro.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Livro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Novo Livro</h1>
    <nav>
        <a href="../index.php">Início</a>
        <a href="../alunos/listar.php">Alunos</a>
        <a href="listar.php" class="active">Livros</a>
        <a href="../emprestimos/listar.php">Empréstimos</a>
    </nav>
</header>

<main>
    <form method="post">
        <label>Título:</label>
        <input type="text" name="titulo" required>

        <label>Autor:</label>
        <input type="text" name="autor" required>

        <label>Categoria:</label>
        <input type="text" name="categoria" required>

        <label>Editora:</label>
        <input type="text" name="editora" required>

        <input type="submit" value="Salvar" class="btn">
    </form>
</main>

<footer>
    <p>&copy; 2025 - Sistema de Biblioteca</p>
</footer>
</body>
</html>
