<?php
include('../includes/conexao.php');

$codigo = $_GET['codigo'] ?? '';

$stmt = $conn->prepare("SELECT * FROM emprestimos WHERE codigo = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();
$emprestimo = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ra_aluno = $_POST['ra_aluno'];
    $codigo_livro = $_POST['codigo_livro'];
    $data_retirada = $_POST['data_retirada'];
    $data_entrega = $_POST['data_entrega'];

    $stmt = $conn->prepare("UPDATE emprestimos SET ra_aluno=?, codigo_livro=?, data_retirada=?, data_entrega=? WHERE codigo=?");
    $stmt->bind_param("sssss", $ra_aluno, $codigo_livro, $data_retirada, $data_entrega, $codigo);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao atualizar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Empréstimo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Editar Empréstimo</h1>
    <nav>
        <a href="../index.php">Início</a>
        <a href="../alunos/listar.php">Alunos</a>
        <a href="../livros/listar.php">Livros</a>
        <a href="listar.php" class="active">Empréstimos</a>
    </nav>
</header>

<main>
<?php if ($emprestimo): ?>
    <form method="post">
        <p><strong>Código:</strong> <?= $emprestimo['codigo'] ?></p>

        <label>RA do Aluno:</label>
        <input type="text" name="ra_aluno" value="<?= $emprestimo['ra_aluno'] ?>" required>

        <label>Código do Livro:</label>
        <input type="text" name="codigo_livro" value="<?= $emprestimo['codigo_livro'] ?>" required>

        <label>Data de Retirada:</label>
        <input type="date" name="data_retirada" value="<?= $emprestimo['data_retirada'] ?>" required>

        <label>Data de Entrega:</label>
        <input type="date" name="data_entrega" value="<?= $emprestimo['data_entrega'] ?>" required>

        <input type="submit" value="Atualizar" class="btn">
    </form>
<?php else: ?>
    <p>Empréstimo não encontrado.</p>
<?php endif; ?>
</main>

<footer>
    <p>&copy; 2025 - Sistema de Biblioteca</p>
</footer>
</body>
</html>
