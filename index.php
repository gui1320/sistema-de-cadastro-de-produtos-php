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

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = $_FILES['foto']['name'];

    // Diretório onde a foto será armazenada
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);

    // Mover a foto para o diretório especificado
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    // Inserir dados na tabela produtos
    $sql = "INSERT INTO produtos (nome, descricao, preco, foto)
    VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $nome, $descricao, $preco, $foto);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar produto: " . $stmt->error;
    }

    // Fechar statement
    $stmt->close();
}
// Fechar conexão
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Cadastro de Produto</h2>

<form method="post" action="" enctype="multipart/form-data">
    <label for="nome">Nome do Produto:</label><br>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="descricao">Descrição do Produto:</label><br>
    <textarea id="descricao" name="descricao" required></textarea><br><br>

    <label for="preco">Preço do Produto:</label><br>
    <input type="number" id="preco" name="preco" step="0.01" required><br><br>

    <label for="foto">Foto do Produto:</label><br>
    <input type="file" id="foto" name="foto" required><br><br>

    <input type="submit" value="Cadastrar Produto">
</form>

</body>
</html>