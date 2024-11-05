<?php
include 'conexao.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$profissao = $_POST['profissao'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

$linhas = $resultado->num_rows;

if ($linhas > 0) {
    echo "Cadastro efetuado.";
} else {
    $sql = "INSERT INTO usuarios (nome, email, profissao) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $profissao);

    if ($stmt->execute()) {
        echo "Cadastro efetuado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
}

$conexao->close();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <nav>
            <ul class="menu">
                <a href="index.php">
                    <li>Cadastro</li>
                </a>
                <a href="consultas.php">
                    <li>Consulta</li>
                </a>
            </ul>
        </nav>
        <section>
            <h1>Confirmação de Cadastro</h1>
            <hr><br><br>

            <?php

            if ($linhas == null) {
                print "Cadastro efetuado com sucesso!";
            } else {
                print "Cadastro NÃO efetuado.<br>Já existe um usuário com este e-mail!";
            }

            ?>

        </section>
    </div>


</body>

</html>