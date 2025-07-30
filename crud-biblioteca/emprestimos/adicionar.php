<?php
include('../includes/conexao.php');

// Função para gerar código único
function gerarCodigo() {
    return uniqid("EMP");
}

// Buscar alunos
$alunos = [];
$resAlunos = $conexao->query("SELECT ra, nome FROM alunos ORDER BY nome");
while ($row = $resAlunos->fetch_assoc()) {
    $alunos[] = $row;
}

// Buscar livros
$livros = [];
$resLivros = $conexao->query("SELECT codigo, titulo FROM livros ORDER BY titulo");
while ($row = $resLivros->fetch_assoc()) {
    $livros[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = gerarCodigo();
    $ra_aluno = $_POST['ra_aluno'];
    $codigo_livro = $_POST['codigo_livro'];
    $data_retirada = $_POST['data_retirada'];
    $data_entrega = $_POST['data_entrega'];

    $stmt = $conexao->prepare("INSERT INTO emprestimos (codigo, ra_aluno, codigo_livro, data_retirada, data_entrega) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $codigo, $ra_aluno, $codigo_livro, $data_retirada, $data_entrega);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao cadastrar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Empréstimo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Novo Empréstimo</h1>
    <nav>
        <a href="../index.php">Início</a>
        <a href="../alunos/listar.php">Alunos</a>
        <a href="../livros/listar.php">Livros</a>
        <a href="listar.php" class="active">Empréstimos</a>
    </nav>
</header>

<main>
    <form method="post">
        <label>RA do Aluno:</label>
        <select name="ra_aluno" required>
            <option value="">Selecione um aluno</option>
            <?php foreach ($alunos as $aluno): ?>
                <option value="<?= $aluno['ra'] ?>"><?= $aluno['ra'] ?> - <?= htmlspecialchars($aluno['nome']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Código do Livro:</label>
        <select name="codigo_livro" required>
            <option value="">Selecione um livro</option>
            <?php foreach ($livros as $livro): ?>
                <option value="<?= $livro['codigo'] ?>"><?= $livro['codigo'] ?> - <?= htmlspecialchars($livro['titulo']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Data de Retirada:</label>
        <input type="date" name="data_retirada" required>

        <label>Data de Entrega:</label>
        <input type="date" name="data_entrega" required>

        <input type="submit" value="Salvar" class="btn">
    </form>
</main>

<footer>
    <p>&copy; 2025 - Sistema de Biblioteca</p>
</footer>
</body>
</html>
