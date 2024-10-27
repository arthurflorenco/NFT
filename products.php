<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário é administrador
if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}

// Exibir lista de produtos
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
/*
while ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>" . $row['title'] . "</h2>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>Preço: " . $row['price'] . "</p>";
    echo "<a href='edit_product.php?id=" . $row['id'] . "'>Editar</a>";
    echo "<a href='delete_product.php?id=" . $row['id'] . "'>Excluir</a>";
}
echo "<a href='add_product.php'>Adicionar Novo Produto</a>";
echo "<br>"
*/

// Incluir o arquivo de notificação de estoque baixo
include 'stock_notification.php';

while ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>" . $row['title'] . "</h2>";
    echo "<p>Estoque: " . $row['quantity'] . "</p>";
    echo "<form action='add_stock.php' method='post'>";
    echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
    echo "<label for='quantity'>Quantidade:</label>";
    echo "<input type='number' id='quantity' name='quantity'>";
    echo "<button>Adicionar Estoque</button>";
    echo "</form>";
}
