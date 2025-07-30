<?php
include('../includes/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Livros</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Gerenciar Livros</h1>
    <nav>
        <a href="../index.php">Início</a>
        <a href="../alunos/listar.php">Alunos</a>
        <a href="listar.php" class="active">Livros</a>
        <a href="../emprestimos/listar.php">Empréstimos</a>
    </nav>
</header>

<main>
    <h2>Lista de Livros</h2>
    <a href="adicionar.php" class="btn">Novo Livro</a>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Categoria</th>
                <th>Editora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM livros";
            $resultado = $conexao->query($sql);
            while ($row = $resultado->fetch_assoc()):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['codigo']) ?></td>
                <td><?= htmlspecialchars($row['titulo']) ?></td>
                <td><?= htmlspecialchars($row['autor']) ?></td>
                <td><?= htmlspecialchars($row['categoria']) ?></td>
                <td><?= htmlspecialchars($row['editora']) ?></td>
                <td>
                    <a href="editar.php?codigo=<?= urlencode($row['codigo']) ?>" class="btn">Editar</a>
                    <a href="excluir.php?codigo=<?= urlencode($row['codigo']) ?>" class="btn btn-danger" onclick="return confirm('Deseja excluir este livro?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<footer>
    <p>&copy; 2025 - Sistema de Biblioteca</p>
</footer>
</body>
</html>
