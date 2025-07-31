<?php
include('../includes/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Empréstimos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Gerenciar Empréstimos</h1>
    <nav>
        <a href="../index.php">Início</a>
        <a href="../alunos/listar.php">Alunos</a>
        <a href="../livros/listar.php">Livros</a>
        <a href="listar.php" class="active">Empréstimos</a>
    </nav>
</header>

<main>
    <h2>Lista de Empréstimos</h2>
    <a href="adicionar.php" class="btn">Novo Empréstimo</a>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>RA do Aluno</th>
                <th>Cód. Livro</th>
                <th>Data Retirada</th>
                <th>Data Entrega</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM emprestimos";
            $resultado = $conexao->query($sql);
            while ($row = $resultado->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['codigo'] ?></td>
                <td><?= $row['ra_aluno'] ?></td>
                <td><?= $row['codigo_livro'] ?></td>
                <td><?= date('d/m/Y', strtotime($row['data_retirada'])) ?></td>
                <td><?= date('d/m/Y', strtotime($row['data_entrega'])) ?></td>
                <td>
                    <a href="editar.php?codigo=<?= $row['codigo'] ?>" class="btn">Editar</a>
                    <a href="excluir.php?codigo=<?= $row['codigo'] ?>" class="btn btn-danger" onclick="return confirm('Deseja excluir?')">Excluir</a>
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
