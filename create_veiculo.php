<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veiculos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];

    // Inserir veículo no banco de dados
    $sql = "INSERT INTO veiculos (modelo, placa, hora_entrada) VALUES ('$modelo', '$placa', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Veículo adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar veículo: " . $conn->error;
    }
}

$conn->close();
?>