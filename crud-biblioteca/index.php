<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Sistema de Biblioteca</title>
    <link rel="stylesheet" href="css/index.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
    <header>
        <div class="container">
            <h1>Sistema de Biblioteca</h1>
            <nav>
                <a href="index.php" class="active">Início</a>
                <a href="alunos/listar.php">Alunos</a>
                <a href="livros/listar.php">Livros</a>
                <a href="emprestimos/listar.php">Empréstimos</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="welcome-section container">
            <h2>Bem-vindo ao Sistema de Biblioteca</h2>
            <p>Gerencie alunos, livros e empréstimos de forma simples e eficiente.</p>
        </section>

        <section class="card-container container">
            <div class="card">
                <h3>Gerenciar Alunos</h3>
                <p>Cadastre, edite e visualize os alunos registrados.</p>
                <a href="alunos/listar.php" class="btn">Acessar</a>
            </div>

            <div class="card">
                <h3>Gerenciar Livros</h3>
                <p>Adicione novos livros e edite os existentes no acervo.</p>
                <a href="livros/listar.php" class="btn">Acessar</a>
            </div>

            <div class="card">
                <h3>Gerenciar Empréstimos</h3>
                <p>Registre e acompanhe os empréstimos de livros.</p>
                <a href="emprestimos/listar.php" class="btn">Acessar</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 - Sistema de Biblioteca</p>
        </div>
    </footer>
</body>
</html>
