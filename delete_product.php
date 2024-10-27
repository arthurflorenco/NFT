<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário é administrador
if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}

// Excluir produto
$id = $_GET["id"];
$query = "DELETE FROM products WHERE id = '$id'";
mysqli_query($conn, $query);

header("Location: products.php");
