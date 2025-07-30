<?php
include('../includes/conexao.php');

$codigo = $_GET['codigo'] ?? '';

if ($codigo) {
    $stmt = $conexao->prepare("DELETE FROM livros WHERE codigo = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
}

header("Location: listar.php");
exit;
?>
