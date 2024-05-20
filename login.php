<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estacionamento Login</title>
    <style>
        body {
            font-family: 'Trebuchet MS', Arial, sans-serif;
            background-color: #222;
            color: #fff;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
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
    </style>
</head>

<body>
<h1>Estacionamento Login</h1>

<?php
function printMessage($message) {
    echo $message. "\n";
}


// Conexão com o banco de dados
$dsn = 'mysql:host=localhost;dbname=estacionamento';
$username = 'root';
$password = '';

try {
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
}

// Verificar se o formulário de login foi submetido

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verificar se o usuário existe no banco de dados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    

    if ($stmt->rowCount() > 0) {
        // Autenticar o usuário
        session_start();
        $_SESSION['usuario'] = $usuario;
        header('Location: login.php');
        exit;
    } else {
        echo 'Usuário ou senha inválidos!';
    }
}

?>

<!-- Formulário de login -->
<form action="login.php" method="post">
    <label for="usuario">Usuário:</label>
    <input type="text" id="usuario" name="usuario"><br><br>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha"><br><br>
    <input type="button" value="Entrar" onclick="location.href='create_veiculo.php';">
</form>

</body>
</html>
