<?php
    require('connect.php');
    $extRef = $_GET['external_reference'] OR header("location: ../");
    $query = mysqli_query($conn, "SELECT * FROM faturas WHERE ref = '$extRef'");
    $result = mysqli_num_rows($query);
    if($result < 1){
        header("location: ../");
    }

// Webhook

$hash = $_COOKIE['hash'];
$queryUser = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
$arrU = mysqli_fetch_assoc($queryUser);

$name = $arrU['user'];

$webhookurl = "https://discord.com/api/webhooks/977955755741298719/sZhtfePrfo84AjZiNLIwMqGpr1wqEz0NHpWPp4mtZSwkPEgTXu9f3YJw93w8PVLKdVh2";

$timestamp = date("c", strtotime("now"));

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
            "description" => "A Fatura do usuário: $name está em aberta!",

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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/css/fatura.css">
    <title>TM STORE</title>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="form">
                <h1 style="color: #ee7c59">Pagamento pendente</h1>
                <p>Seu pagamento está pendente, espere em 1 a 3 dias para receber seu produto.</p>
                <a href="index.php" class="btn">Inicio</a>
                <a href="panel/faturas.php" class="btn">Faturas</a>
            </div>
        </div>
    </div>
</body>
</html>