<?php
// Informações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'sistema';
$username = 'root';
$password = '';

// Criar conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Selecionar todos os produtos da tabela produtos
$sql = "SELECT nome, descricao, preco, foto FROM produtos";
$result = $conn->query($sql);

// Exibir os produtos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row['nome'] . "</h2>";
        echo "<p><strong>Descrição:</strong> " . $row['descricao'] . "</p>";
        echo "<p><strong>Preço:</strong> R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
        echo '<img src="uploads/' . $row['foto'] . '" alt="' . $row['nome'] . '" width="200"><br><br>';
    }
} else {
    echo "Nenhum produto cadastrado.";
}

// Fechar conexão
$conn->close();
?>