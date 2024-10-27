<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário é administrador
if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}

// Exibir lista de clientes
$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>Email: " . $row['email'] . "</p>";
    echo "<a href='edit_customer.php?id=" . $row['id'] . "'>Editar</a>";
}

echo "<a href='add_customer.php'>Adicionar Novo Cliente</a>";
