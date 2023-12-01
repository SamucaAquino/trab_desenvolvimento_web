<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    if (empty($nome) || empty($email) || empty($mensagem)) {
        $erro = "Todos os campos são obrigatórios.";
    } else {
        $sucesso = "Mensagem enviada com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Relaxe Gostoso - Contato</title>
    <link rel="stylesheet" type="text/css" href="style_contato.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <h2>Entre em Contato</h2>

        <form method="post" action="contato.php">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" name="email" required>

            <label for="mensagem">Mensagem:</label>
            <textarea name="mensagem" required></textarea>

            <input type="submit" name="submit" value="Enviar Mensagem">
        </form>

        <?php
        if (isset($sucesso)) {
            echo "<p class='success'>$sucesso</p>";
        } elseif (isset($erro)) {
            echo "<p class='error'>$erro</p>";
        }
        ?>
    </main>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>
</html>

