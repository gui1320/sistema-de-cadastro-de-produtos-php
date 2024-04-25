<?php
// Verifica se o ID do produto foi fornecido na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Conexão com o banco de dados (substitua os valores conforme necessário)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];

        // Query para atualizar os dados do produto no banco de dados
        $sql = "UPDATE produtos SET nome='$nome', preco='$preco' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Produto atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar produto: " . $conn->error;
        }
    }

    // Consulta o produto específico com base no ID
    $sql = "SELECT nome, preco FROM produtos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $preco = $row["preco"];
    } else {
        echo "Produto não encontrado.";
        exit();
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID do produto não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
</head>
<body>

<h2>Editar Produto</h2>

<form action="<?php echo ($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
    Nome: <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
    Preço: <input type="text" name="preco" value="<?php echo $preco; ?>"><br>
    <input type="submit" value="Atualizar">
</form>

</body>
</html>
