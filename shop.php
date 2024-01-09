<?php
session_start();
require('connect.php');

if (!isset($_COOKIE['hash'])) {
    header('Location: login.php');
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

<body class="modal-open" style="overflow-x: hidden; padding-right: 0px;" data-bs-overflow="hidden" data-bs-padding-right="0px">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-md">
            <a class="navbar-brand" href="#"><img id="imglogo" src="app/img/logo.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Ínicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="shop.php">Loja</a>
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
                    
    <div class="content mt-7">
        <div class="container-md2 mt-6">
        <div class="row">
                <div class="text-center">
                    <p class="title" data-text="Notry Tv">Notry Tv</p>
                    <p class="stitle">DESEJA COMPRAR PRODUTOS EM NOSSA LOJA VIRTUAL?</p>
                    <div class="modal-dialog" style="max-width: 550px">
            <div class="modal-content" style="background-color: transparent; border: none">

                <div class="modal-body">

                    <div class="shop">
                        <div class="shop-content">
                            <div class="shop-content-header">
                                <p class="name">Compre Pontos</p>
                                <p class="description"><b>NOTRYPOINTS</b> são a nova moeda exclusiva do Hyze! Você pode usá-los para adquirir VIP exclusivos no jogo desde de <b>vantagens</b> pro seu personagem.</p>
                            </div>
                            <div class="shop-content-body text-center">
                                <form method="post" >
                                    <input name="coins" type="range" min="1000" max="300000" step="1000" id="count" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)">
                                    <div class="buttons">
                                    <p class="value2">
                                        <span id="valuepontos">1000</span><br>
                                        <span class="pp">Total de pontos</span>
                                    </p>
                                    <p class="value"><span>R$</span>
                                        <span id="valueaqui">1,00</span><br>
                                        <span class="pp">Total a pagar</span>
                                    </p>
                                    </div>
                                    <button type="submit" name="buyCoins" class="btn">Comprar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>


    <div class="footer" style="margin-top: 50px">
        <p class="copy">Grand Theft Auto é uma marca registrada Rockstar
            Games e não vinculada a este site.</p>
        <p class="enterprise">Copyright © 2022 - <span>NotryTv</span></p>
        
    </div>

    <script type="text/javascript">
        function rangeSlide(value) {
            var newValue = value / 1000;
            var pontos = newValue * 1000;
            document.getElementById('valueaqui').innerHTML = newValue + ',00';
            document.getElementById('valuepontos').innerHTML = pontos;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


<?php
    if (isset($_POST['buyCoins'])){

            $data = date("F j, Y, g:i a");
            $hash = $_COOKIE['hash'];
            $queryC = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
            $arrC = mysqli_fetch_assoc($queryC);
            $user = $arrC['user'];
            $idmta = $arrC['idmta'];
            $value = intval($_POST['coins'])/ 1000;
            $valuenew = $value;
            $pontos = $valuenew * 1000;
            $id = rand(5000, 50000);

            $ref = 'MP-'.$id;
            
            $qury = mysqli_query($conn, "INSERT INTO faturas (user, idmta, ref, date, valor, quantidade, status, metodo, setado, cupom) VALUES ('$user', '$idmta', '$ref', '$data' ,'$valuenew', '$pontos', 'Pendente', 'MercadoPago', 'false', 'false')") or die("Morri");

            if ($qury) {
                
                $_SESSION['Pagar'] = $ref;

                echo "<script>location.href='finaliza.php?id=$ref';</script>";

                // Webhook
$hash = $_COOKIE['hash'];
$queryUser = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
$arrU = mysqli_fetch_assoc($queryUser);

$name = $arrU['user'];

$webhookurl = "https://discord.com/api/webhooks/977955755741298719/sZhtfePrfo84AjZiNLIwMqGpr1wqEz0NHpWPp4mtZSwkPEgTXu9f3YJw93w8PVLKdVh2";

$timestamp = date("c", strtotime("now"));

$valornovo = number_format($valuenew, 2,",",",");

$json_data = json_encode([
    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => "**Notry Tv**",

            // Embed Type
            "type" => "rich",
            // Embed Description

            "description" => "A Fatura do usuário: $name abriu uma fatura no valor: R$: $valornovo",

            // URL of title link
            "url" => "https://NotryTv.com.br",

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "#9421f1" ),

            // Footer
            "footer" => [
                "text" => "Coypright © Notry Tv",
            ],
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );
            }else{
                $_COOKIE['error'] = "Desculpe! Houve um erro, tente novamente mais tarde!";
            }
    }


    if(isset($_COOKIE['error'])){
        echo $_COOKIE['error'];
    }
?>