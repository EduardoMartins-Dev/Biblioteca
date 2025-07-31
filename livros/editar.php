<?php
include('../includes/conexao.php');

$codigo = $_GET['codigo'] ?? '';

$stmt = $conexao->prepare("SELECT * FROM livros WHERE codigo = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();
$livro = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $editora = $_POST['editora'];

    $stmt = $conexao->prepare("UPDATE livros SET titulo=?, autor=?, categoria=?, editora=? WHERE codigo=?");
    $stmt->bind_param("sssss", $titulo, $autor, $categoria, $editora, $codigo);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao atualizar o livro.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Editar Livro</h1>
    <nav>
        <a href="../index.php">Início</a>
        <a href="../alunos/listar.php">Alunos</a>
        <a href="listar.php" class="active">Livros</a>
        <a href="../emprestimos/listar.php">Empréstimos</a>
    </nav>
</header>

<main>
<?php if ($livro): ?>
    <form method="post">
        <p><strong>Código:</strong> <?= htmlspecialchars($livro['codigo']) ?></p>

        <label>Título:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required>

        <label>Autor:</label>
        <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>

        <label>Categoria:</label>
        <input type="text" name="categoria" value="<?= htmlspecialchars($livro['categoria']) ?>" required>

        <label>Editora:</label>
        <input type="text" name="editora" value="<?= htmlspecialchars($livro['editora']) ?>" required>

        <input type="submit" value="Atualizar" class="btn">
    </form>
<?php else: ?>
    <p>Livro não encontrado.</p>
<?php endif; ?>
</main>

<footer>
    <p>&copy; 2025 - Sistema de Biblioteca</p>
</footer>
</body>
</html>
