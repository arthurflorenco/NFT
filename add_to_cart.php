<?php
session_start();

// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Adicionar produto ao carrinho
$price = $_POST['price'];
$product_id = $_POST["product_id"];
$customer_id = $_SESSION["user_id"];
$query = "INSERT INTO cart (price, customer_id, product_id, quantity) VALUES ('$price','$customer_id', '$product_id', 1)";
mysqli_query($conn, $query);

// Redirecionar para a página de carrinho
header("Location: cart.php");
