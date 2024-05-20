<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carros</title>
    <!-- Inclusão do Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Trebuchet MS', Arial, sans-serif;
            background-color: #222;
            color: #fff;
            padding: 20px;
        }
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
        }
        label {
            font-weight: bold;
            color: #fff;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.5);
            color: #333;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        h2 {
            color: #fff;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
            margin-left: 10px;
        }
        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
<h1>Cadastro de Carros</h1>

<?php
// cadastro_carros.php

// Conexão com o banco de dados
$dsn = 'mysql:host=localhost;dbname=estacionamento';
$username = 'root';
$password = '';

try {
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
}

// Verificar se o formulário de cadastro foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];

    // Inserir carro no banco de dados
    $stmt = $conn->prepare('INSERT INTO carros (placa, marca) VALUES (:placa, :marca)');
    $stmt->bindParam(':placa', $placa);
    $stmt->bindParam(':marca', $marca);
    $stmt->execute();

    echo 'Carro cadastrado com sucesso!';
}

// Listar carros cadastrados
$stmt = $conn->prepare('SELECT * FROM carros');
$stmt->execute();

$carros = $stmt->fetchAll();

?>

<!-- Formulário de cadastro -->
<div class="container">
    <form action="cadastro_carros.php" method="post">
        <div class="form-group">
            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" class="form-control">
        </div>
        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <!-- Listar carros cadastrados -->
    <h2>Carros Cadastrados</h2>
    <ul>
        <?php foreach ($carros as $carro) { ?>
            <li>
                Placa: <?= $carro['placa'] ?> - Marca: <?= $carro['marca'] ?>  
                <a href="editar_carro.php?id=<?= $carro['id'] ?>" class="btn btn-secondary">Editar</a>
                <a href="excluir_carro.php?id=<?= $carro['id'] ?>" class="btn btn-danger">Excluir</a>
            </li>
        <?php } ?>
    </ul>
</div>

</body>
</html>
