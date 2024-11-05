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
                    <li>Consultas</li>
                </a>
            </ul>
        </nav>
        <section>
            <h1>Consultas</h1>
            <hr><br><br>

            <form method="get" action="">
                Filtrar por profissão: <input type="text" name="filtro" class="campo" autofocus>
                <input type="submit" value="Pesquisar" class="btn">
            </form>

            <?php

            include('conexao.php');

            $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';

            $filtro = mysqli_real_escape_string($conexao, $filtro);

            if ($filtro) {
                $consulta = mysqli_query($conexao, "SELECT * FROM usuarios WHERE profissao LIKE '%$filtro%'");
            } else {
                $consulta = mysqli_query($conexao, "SELECT * FROM usuarios");
            }

            $registros = mysqli_num_rows($consulta);

            if ($filtro) {
                echo "Resultado da pesquisa com a palavra <strong>$filtro</strong>.<br><br>";
            } else {
                echo "Exibindo todos os registros.<br><br>";
            }

            echo "$registros registros encontrados.<br><br>";

            while ($exibirRegistros = mysqli_fetch_array($consulta)) {
                $codigo = $exibirRegistros['codigo'];
                $nome = $exibirRegistros['nome'];
                $email = $exibirRegistros['email'];
                $profissao = $exibirRegistros['profissao'];

                echo "<article>";
                echo "Código: $codigo<br>";
                echo "Nome: $nome<br>";
                echo "E-mail: $email<br>";
                echo "Profissão: $profissao<br><br>";
                echo "</article>";
            }

            mysqli_close($conexao);
            ?>

        </section>
    </div>
</body>

</html>
