<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "biblioteca";
try {
    // Tentar estabelecer a conexão
    $conexao = @mysqli_connect($host, $user, $pass, $banco);
    // Verificar se a conexão foi bem-sucedida
    if (!$conexao) {
        throw new Exception("Problemas ao se conectar ao banco de dados: " . mysqli_connect_error());
    }

} catch (Exception $e) {
    // Capturar a exceção e exibir a mensagem de erro
    echo "error:". $e->getMessage();
}
?>
