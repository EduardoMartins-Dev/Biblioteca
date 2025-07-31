<?php
include('../includes/conexao.php');

function gerarRA() {
    return uniqid(rand(1000, 9999));
}

$ra = gerarRA();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];

    $stmt = $conexao->prepare("INSERT INTO alunos (ra, nome, email, telefone, data_nascimento) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $ra, $nome, $email, $telefone, $data_nascimento);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit;
    } else {
        $erro = "Erro ao adicionar aluno: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Aluno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include('../includes/header.php'); ?>

<main>
    <h2>Novo Aluno</h2>

    <?php if (!empty($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

    <form method="post">
        <p><strong>RA Gerado:</strong> <?= $ra ?></p>
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone"><br><br>

        <label>Data de Nascimento:</label><br>
        <input type="date" name="data_nascimento"><br><br>

        <input type="submit" value="Salvar" class="btn">
    </form>
</main>

<?php include('../includes/footer.php'); ?>
</body>
</html>
