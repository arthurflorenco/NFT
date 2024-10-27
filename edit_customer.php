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

// Editar cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "UPDATE customers SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
    mysqli_query($conn, $query);

    header("Location: customers.php");
    exit;
}

// Obter informações do cliente
$id = $_GET["id"];
$query = "SELECT * FROM customers WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" value="<?php echo $row["name"]; ?>"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $row["email"]; ?>"><br><br>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" value="<?php echo $row["password"]; ?>"><br><br>
    <button>Salvar Alterações</button>
</form>