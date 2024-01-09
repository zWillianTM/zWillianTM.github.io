<?php
session_start();
require('connect.php');
include('app/MercadoPago/mp.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $queryzinha = mysqli_query($conn, "SELECT * FROM faturas WHERE ref='$id' LIMIT 1");
    $queryUser = mysqli_query($conn, "SELECT * FROM accounts");
    $ArrU = mysqli_fetch_assoc($queryUser);
    if($queryzinha){
        $fat = mysqli_fetch_assoc($queryzinha);
        $value = $fat['valor'];
        $url = "https://localhost";
        $title = 'Hz Points';

   # Create a preference object
    $preference = new MercadoPago\Preference();
    # Create an item object
    $item = new MercadoPago\Item();
    $item->id = "$id";
    $item->title = $title;
    $item->quantity = 1;
    $item->currency_id = "BRL";
    $item->unit_price = $fat['valor'];
    # Create a payer object
    $payer = new MercadoPago\Payer();
    $payer->email = $ArrU['email'];
    $payer->name = $ArrU['user'];
    # Settings preference properties
    $preference->items = array($item);
    $preference->payer = $payer;
    # Redirect
    $url = "https://localhost";
    $preference->back_urls = array(
        "success" => "$url/paymentSuccess.php",
        "failure" => "$url/paymentFailure.php",
        "peding" => "$url/paymentPeding.php"
    );
    $preference->auto_return = "approved";
    # Hash
    $extRef = $fat['ref'];
    $preference->external_reference = "$extRef";
    # Save and posting preference
    $preference->save();
    $price = $fat['valor'];
    $date = date("Y-m-d H:i:s");
    header("location: $preference->init_point");
    }
}

?>

<script>
    window.onload = function() {
      var link = document.getElementById("btnMP").href;
      window.location.href = link;
    }
  </script>