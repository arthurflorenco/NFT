<?php
session_start();

// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Processar informações de pagamento
$payment_method = $_POST["payment_method"];
$total = $_POST["total"];

// Criar nova encomenda
$query = "INSERT INTO orders (customer_id, order_date, total) VALUES ('" . $_SESSION["user_id"] . "', NOW(), '$total')";
mysqli_query($conn, $query);

// Atualizar carrinho de compras
$query = "DELETE FROM cart WHERE customer_id = '" . $_SESSION["user_id"] . "'";
mysqli_query($conn, $query);

// Redirecionar para a página de confirmação
header("Location: confirmation.php");
