<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o estoque de um produto está baixo
$query = "SELECT * FROM products WHERE quantity < 10";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    // Enviar email para o administrador
    $to = "admin@test.com";
    $subject = "Estoque Baixo: " . $row['title'];
    $message = "O estoque do produto " . $row['title'] . " está baixo. Por favor, adicione mais estoque.";
    mail($to, $subject, $message);
}
