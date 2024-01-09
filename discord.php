<?php
function sendDiscord($cliente, $fatura, $metodo)
{
    $webhookurl = "";

    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([

        "username" => "NotryTv Vendedor",

        "avatar_url" => "https://media.discordapp.net/attachments/969043153074126899/969043933978046474/unknown.png?width=478&height=478",

        "tts" => false,

        #"file" => '../logs/' . $ticket . '.txt',

        "embeds" => [
            [
                "title" => 'Nova Compra!',

                "type" => "rich",

                "description" => 'Foi realizado uma nova compra no site!',

                "timestamp" => $timestamp,

                "color" => hexdec("3366ff"),

                "footer" => [
                    "text" => "",
                    "icon_url" => "https://media.discordapp.net/attachments/969043153074126899/969043933978046474/unknown.png?width=478&height=478"
                ],

                "thumbnail" => [
                    "url" => 'https://media.discordapp.net/attachments/969043153074126899/969043933978046474/unknown.png?width=478&height=478'
                ],

                "fields" => [
                    [
                        "name" => "👤 Cliente",
                        "value" => $cliente,
                        "inline" => true
                    ],
                    [
                        "name" => "💰 Fatura",
                        "value" => $fatura,
                        "inline" => true
                    ],
                    [
                        "name" => "💳 Método de Pagamento",
                        "value" => $metodo,
                        "inline" => true
                    ]
                    ],
            ]
        ]

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


    $ch = curl_init($webhookurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);
};