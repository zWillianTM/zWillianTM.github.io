<?php
    session_start();
    require('connect.php');
    include('app/MercadoPago/lib/mercadopago.php');
    include('app/PagamentoMP.php');
    
    if (!isset($_COOKIE['hash'])) {
        header('Location: index.php');
    }
    
    $hash = $_COOKIE['hash'];
    $queryAdmin = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
    $arrA = mysqli_fetch_assoc($queryAdmin);
    if($arrA['adm'] < 1){
        header("Location: ../");
    }else{
        $id = $_GET['id'] OR header("location: cupons.php");
        mysqli_query($conn, "DELETE FROM `cupons` WHERE id = '$id'");
        header("Location: cupons.php");
    }
?>