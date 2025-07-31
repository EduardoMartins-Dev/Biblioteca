<?php
include('../includes/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alunos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include('../includes/header.php'); ?>

<main>
    <h2>Lista de Alunos</h2>
    <a href="adicionar.php" class="btn">Novo Aluno</a>

    <table>
        <thead>
            <tr>
                <th>RA</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM alunos";
            $resultado = $conexao->query($sql);

            while ($aluno = $resultado->fetch_assoc()):
            ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['ra']) ?></td>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['email']) ?></td>
                    <td><?= htmlspecialchars($aluno['telefone']) ?></td>
                    <td><?= date("d/m/Y", strtotime($aluno['data_nascimento'])) ?></td>
                    <td>
                        <a href="editar.php?ra=<?= $aluno['ra'] ?>" class="btn">Editar</a>
                        <a href="excluir.php?ra=<?= $aluno['ra'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include('../includes/footer.php'); ?>
</body>
</html>
<?php
$conexao->close();