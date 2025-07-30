<?php
include('../includes/conexao.php');

$codigo = $_GET['codigo'] ?? '';

if ($codigo) {
    $stmt = $conn->prepare("DELETE FROM emprestimos WHERE codigo = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
}

header("Location: listar.php");
exit;
?>
