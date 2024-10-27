<?php
session_start();

// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "root", "", "e_commerce");

// Verificar se há produtos disponíveis
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
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
            <a class="navbar-brand" href="#"><img src="images/rareblocks.svg" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">About</a>
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
    <section class="hero">
        <div class="content">
            <p class="days">– Day 34/1000</p>
            <h1>NFT<br>ARTS</h1>
            <p>Fuape is a collection of 1000 funny ape NFTs - unique digital collectibles living on the Ethereum blockchain.</p>
        </div>
        <?php if ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="nft container">
                <img src="images/NFT.svg" alt="NFT">
                <div class="info-nft">
                    <div class="one">
                        <p>Current Bid</p>
                        <h3>Ξ <?php echo $row['price'] ?> ETH</h3>
                    </div>
                    <div class="two">
                        <p>Bids Ends In</p>
                        <h3 class="time">12h:39:41s</h3>
                    </div>
                </div>
                <form class="form-nft" action="add_to_cart.php" method="post">
                    <input type="hidden" name="price" value="<?php echo $row['price'] ?>">
                    <input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">
                    <button type="submit" class="btn-buy">Bid on Opensea</button>
                </form>
            </div>
        <?php } ?>
    </section>
    <script>
        let dias = 34;
        let horas = 0;
        let minutos = 0;
        let segundos = 0;

        let intervalo = setInterval(contagemRegressiva, 1000);

        function contagemRegressiva() {
            segundos--;
            if (segundos < 0) {
                minutos--;
                segundos = 59;
            }
            if (minutos < 0) {
                horas--;
                minutos = 59;
            }
            if (horas < 0) {
                dias--;
                horas = 23;
            }
            if (dias < 0) {
                clearInterval(intervalo);
                document.querySelector('.days').innerHTML = 'Tempo esgotado!';
            } else {
                document.querySelector('.days').innerHTML = `– Day ${dias}/${1000}`;
                document.querySelector('.time').innerHTML = `${horas.toString().padStart(2, '0')}h:${minutos.toString().padStart(2, '0')}m:${segundos.toString().padStart(2, '0')}s`;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>