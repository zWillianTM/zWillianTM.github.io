<?php 
session_start();
require('connect.php');

if (!isset($_COOKIE['hash'])) {
    header('Location: index.php');
}

$hash = $_COOKIE['hash'];
$queryAdmin = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
$arrA = mysqli_fetch_assoc($queryAdmin);
if($arrA['adm'] < 1){
    header("Location: ../");
}

if (isset($_POST['send'])){
    $cupom =  $_POST['cupom_notry'];
    $valor =  $_POST['valor_notry'];
    $sql = mysqli_query($conn, "SELECT * FROM `cupons` WHERE cupom = '$cupom'");
    $verify = mysqli_num_rows($sql);
    if($verify < 1){
        mysqli_query($conn, "INSERT INTO `cupons`(`cupom`, `valor`, `usos`, `status`) VALUES ('$cupom','$valor','0','true')");
        header("location: cupons.php");
    }else{
        $error = "Já existe um cupom com este nome!";
    }
}else{
    $error = "";
}

?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link href="app/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel='icon' href='app/img/logo.png' type='image/png'>
        <title>Notry Tv</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-md">
                <a class="navbar-brand" href="#"><img id="imglogo"
                        src="app/img/logo.png"></a>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                    id="navbarSupportedContent">
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Ínicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Loja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="termos.php">Termos</a>
                        </li>
                    </ul>
                    <?php
                    if(isset($_COOKIE['hash'])){
                        echo '<a class="btn" href="client.php">Área do cliente</a>';

                        $hash = $_COOKIE['hash'];
                        $queryAdmin = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
                            $arrA = mysqli_fetch_assoc($queryAdmin);
                            if($arrA['adm'] > 0){
                            echo '<a class="btn" href="admin.php">Área administrador</a>';
                        }
                    }else{
                        echo '<a class="btn" href="login.php">Fazer login</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>

        <div class="login" style="margin-top: 100px">
            <div class="container-md">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="login-content">
                            <h1 class="title">Adicionar cupons</h1>
                            <span style="color: red"><?php echo $error ?></span>
                            <form method="post" action="">
                                <label for="cupom_notry">Cupom:</label>
                                <input type="text" name="cupom_notry">
                                <label for="valor_notry">Valor: (Apénas números)</label>
                                <input type="number" name="valor_notry" min="1" max="100">

                                <button type="submit" name="send" class="btn">Adicionar</button>

                                <p class="singin">Precisa de ajuda? <a href="https://discord.gg/mmTfJx7V8C" target="_blank">Suporte</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>