    <?php
        require('connect.php');

        $extRef = $_GET['external_reference'] OR header("location: ../");
        $query = mysqli_query($conn, "SELECT * FROM faturas WHERE ref = '$extRef'");
        $result = mysqli_num_rows($query);
        if($result < 1){
            header("location: ../");
        }
        $arr = mysqli_fetch_assoc($query);
        if($arr['status'] == 'true'){
            header("location: ../");
        }
        if($arr['setado'] == 'false'){
        mysqli_query($conn, "UPDATE `faturas` SET `status`='Aprovado', `setado`='true' WHERE ref = '$extRef'");
        $queryUser = mysqli_query($conn, "SELECT * FROM accounts");
        $arrC = mysqli_fetch_assoc($queryUser);
        $valorpontos = $arr['quantidade'];
        $idmta = $arrC['idmta'];

        $hash = $_COOKIE['hash'];
        $queryUser = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
        $arrU2 = mysqli_fetch_assoc($queryUser);
        $user = $arrU2['user'];

        $queryCliente = mysqli_query($conn, "SELECT * FROM totalclient WHERE user = '$user'");
        $arrCl = mysqli_fetch_assoc($queryCliente);
        $valor = $arrCl['valor'] + $arr['valor'];
        $pontos = $arrCl['pontos'] + $valorpontos;
        mysqli_query($conn, "UPDATE `totalclient` SET `valor`='$valor',`pontos`='$pontos' WHERE user='$user'");

        mysqli_query($conn, "UPDATE `total` SET `valor`='$valor',`pontos`='$pontos'");

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
                "description" => "A Fatura do usuário: $name paga com sucesso!",

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

    }
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
                    <h1 style="color: green">Pagamento aprovado</h1>
                    <p>Seu pagamento foi aprovado e ja foi adicionado a sua conta. Clique nas opções abaixo para saber mais!</p>
                    <a href="index.php" class="btn">Inicio</a>
                    <a href="client.php" class="btn">Faturas</a>
                </div>
            </div>
        </div>
    </body>
    </html>

    <script>
        setTimeout(function () {
   window.location.href= 'index.php'; // the redirect goes here

},5000); // 5 seconds
    </script>