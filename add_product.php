<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário é administrador
/*
if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}
*/

// Adicionar novo produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $query = "INSERT INTO products (title, description, price) VALUES ('$title', '$description', '$price')";
    mysqli_query($conn, $query);

    header("Location: products.php");
    exit;
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title"><br><br>
    <label for="description">Descrição:</label>
    <textarea id="description" name="description"></textarea><br><br>
    <label for="price">Preço:</label>
    <input type="number" id="price" name="price"><br><br>
    <button>Adicionar Produto</button>
</form>