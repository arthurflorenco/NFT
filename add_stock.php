<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário é administrador
if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}

// Adicionar estoque
$product_id = $_POST["product_id"];
$quantity = $_POST["quantity"];

$query = "INSERT INTO stock (product_id, quantity) VALUES ('$product_id', '$quantity')";
mysqli_query($conn, $query);

// Atualizar estoque do produto
$query = "UPDATE products SET quantity = quantity + '$quantity' WHERE id = '$product_id'";
mysqli_query($conn, $query);

header("Location: products.php");
