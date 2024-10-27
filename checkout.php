<?php
session_start();

// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Exibir informações de pagamento
$query = "SELECT * FROM cart WHERE customer_id = '" . $_SESSION["user_id"] . "'";
$result = mysqli_query($conn, $query);

$total = 0;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rareblocks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/rareblocks.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="body">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="images/rareblocks.svg" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Apes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <button type="button" onclick="<?php
                                                    // Verificar se o usuário está logado
                                                    if (!isset($_SESSION["user_id"])) {
                                                        echo "location.href='login.php';";
                                                    } else {
                                                        echo "location.href='cart.php';";
                                                    } ?>" class="btn-login">Connect Wallet</button>
                </span>
            </div>
        </div>
    </nav>
    <div class="checkout">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['price'] * $row['quantity'];
        }

        echo "<h2>Finalizar Compra</h2>";
        echo "<form action='process_payment.php' method='post'>";
        echo "<input id='total' name='total' value='" . $total . "' readonly>";
        echo "<label for='payment_method'>Método de Pagamento:</label>";
        echo "<select id='payment_method' name='payment_method'>";
        echo "<option value='credit_card'>Cartão de Crédito</option>";
        echo "<option value='paypal'>PayPal</option>";
        echo "</select>";
        echo "<button>Finalizar Compra</button>";
        echo "</form>";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>