<?php
include('../includes/conexao.php');

$ra = $_GET['ra'] ?? '';

if ($ra) {
    $stmt = $conn->prepare("DELETE FROM alunos WHERE ra = ?");
    $stmt->bind_param("s", $ra);
    $stmt->execute();
}

header("Location: listar.php");
exit;
?>
