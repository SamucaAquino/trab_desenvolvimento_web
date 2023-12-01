<?php
include 'config.php';

function inserirServico($nome, $descricao) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO services (nome, descricao) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $descricao);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];

    if (empty($nome) || empty($descricao)) {
        $erro = "Todos os campos são obrigatórios.";
    } else {
        if (inserirServico($nome, $descricao)) {
            $sucesso = "Serviço adicionado com sucesso!";
        } else {
            $erro = "Erro ao adicionar o serviço.";
        }
    }
}

$result = $conn->query("SELECT * FROM services");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Relaxe Gostoso - Serviços</title>
    <link rel="stylesheet" type="text/css" href="style_servicos.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <h2>Nossos Serviços</h2>
        <p>Oferecemos uma variedade de serviços para atender às suas necessidades de relaxamento e cuidado pessoal.</p>
        <ul>
            <li>
                <h3><a href="serv_um.html">Massagens Terapêuticas</a></h3>
                <p>Desfrute de massagens relaxantes realizadas por terapeutas qualificados.</p>
            </li>
            <li>
                <h3><a href="serv_dois.html">Tratamentos de Beleza</a></h3>
                <p>Cuidados especiais para a sua beleza, incluindo tratamentos faciais e corporais.</p>
            </li>
            <li>
                <h3><a href="serv_tres.html">Yoga e Meditação</a></h3>
                <p>Experimente a terapia dos aromas para promover o equilíbrio e bem-estar.</p>
            </li>
            <li>
                <h3>Sessões de Yoga e Meditação</h3>
                <p>Participe de aulas de yoga e meditação para uma experiência completa de relaxamento.</p>
            </li>
        <form method="post" action="servicos.php">
            <label for="nome">Nome do Serviço:</label>
            <input type="text" name="nome" required>

            <label for="descricao">Descrição do Serviço:</label>
            <textarea name="descricao" required></textarea>

            <input type="submit" name="submit" value="Adicionar Serviço">
        </form>

        <?php
        if (isset($sucesso)) {
            echo "<p class='success'>$sucesso</p>";
        } elseif (isset($erro)) {
            echo "<p class='error'>$erro</p>";
        }
        ?>

        <ul>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<li>{$row['nome']} - {$row['descricao']}</li>";
            }
            ?>
        </ul>
    </main>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>
</html>
