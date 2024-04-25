<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Query para excluir o produto do BD
    $sql = "DELETE FROM produtos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Produto excluído.";
    } else {
        echo "Erro ao excluir produto: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ID não encontrado.";
    exit();
}
?>
