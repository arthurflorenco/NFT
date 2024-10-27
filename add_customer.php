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

// Adicionar novo cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "INSERT INTO customers (name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($conn, $query);

    header("Location: customers.php");
    exit;
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password"><br><br>
    <button>Adicionar Cliente</button>
</form>