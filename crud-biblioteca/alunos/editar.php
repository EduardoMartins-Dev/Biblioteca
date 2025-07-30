<?php
include('../includes/conexao.php');

$ra = $_GET['ra'] ?? '';
$stmt = $conexao->prepare("SELECT * FROM alunos WHERE ra = ?");
$stmt->bind_param("s", $ra);
$stmt->execute();
$result = $stmt->get_result();
$aluno = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];

    $stmt = $conexao->prepare("UPDATE alunos SET nome=?, email=?, telefone=?, data_nascimento=? WHERE ra=?");
    $stmt->bind_param("sssss", $nome, $email, $telefone, $data_nascimento, $ra);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit;
    } else {
        $erro = "Erro ao atualizar aluno.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include('../includes/header.php'); ?>

<main>
    <h2>Editar Aluno</h2>

    <?php if (!empty($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

    <?php if ($aluno): ?>
    <form method="post">
        <p><strong>RA:</strong> <?= $aluno['ra'] ?></p>

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= $aluno['nome'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $aluno['email'] ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= $aluno['telefone'] ?>"><br><br>

        <label>Data de Nascimento:</label><br>
        <input type="date" name="data_nascimento" value="<?= $aluno['data_nascimento'] ?>"><br><br>

        <input type="submit" value="Atualizar" class="btn">
    </form>
    <?php else: ?>
        <p>Aluno não encontrado.</p>
    <?php endif; ?>
</main>

<?php include('../includes/footer.php'); ?>
</body>
</html>
