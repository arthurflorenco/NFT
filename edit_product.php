<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário é administrador
if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}

// Editar produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $query = "UPDATE products SET title = '$title', description = '$description', price = '$price' WHERE id = '$id'";
    mysqli_query($conn, $query);

    header("Location: products.php");
    exit;
}

// Obter informações do produto
$id = $_GET["id"];
$query = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" value="<?php echo $row["title"]; ?>"><br><br>
    <label for="description">Descrição:</label>
    <textarea id="description" name="description"><?php echo $row["description"]; ?></textarea><br><br>
    <label for="price">Preço:</label>
    <input type="number" id="price" name="price" value="<?php echo $row["price"]; ?>"><br><br>
    <button>Salvar Alterações</button>
</form>