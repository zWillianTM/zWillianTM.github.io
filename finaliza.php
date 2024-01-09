<?php
  session_start();
  if (!isset($_COOKIE['hash'])) {
    header('Location: index.php');
  }
  require('connect.php');

  $id = $_GET['id'] OR header("location: ../");
  $queryzinha = mysqli_query($conn, "SELECT * FROM faturas WHERE ref='$id' LIMIT 1");
  $fat = mysqli_fetch_assoc($queryzinha);
  $valor = $fat['valor'];

  if($fat['cupom'] == 'true'){
    $error = "Você já está utilizando este cupom!";
  }else{
  if(isset($_POST['attcupom'])){
    $cupom = $_POST['cupom'];

    $queryCupons = mysqli_query($conn, "SELECT * FROM cupons WHERE cupom='$cupom'");
    $arrC = mysqli_fetch_assoc($queryCupons);
    $result = mysqli_num_rows($queryCupons);
    if($result > 0){
    if($arrC['status'] == 'true'){
      $cupomativo = $arrC['valor'];
      $valor = $fat['valor']-( $fat['valor'] / 100 * $cupomativo);
      $error = "";
      $usos = $arrC['usos'] + 1;
      $cupons = mysqli_query($conn, "UPDATE `cupons` SET `usos`='$usos'");
      $success = "Seu cupom foi ativo com sucesso! <br> -$cupomativo% de desconto!";
      mysqli_query($conn, "UPDATE `faturas` SET`valor`='$valor', `cupom`='true' WHERE ref='$id' LIMIT 1");

    }else{
        $error = "Cupom Inválido!";
        $valor = $fat['valor'];
        $success = "";
    }
    }else{
      $error = "Cupom suspenso!";
      $valor = $fat['valor'];
      $success = "";
    }
  }
}

  $error = "";
  $success = "";
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link href="app/css/panel.css" rel="stylesheet">
        <link href="app/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <script src="https://kit.fontawesome.com/504e341a3c.js" crossorigin="anonymous"></script>
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

        <section class="scriptcontent" style="margin-top: 100px">
          <div class="container">
            <div class="row">
              <div class="col-md-7">
                <div class="demo1" style="height: 330px;">
                  <p class="name">Pedido</p>
                  <div class="checkout">
                  <i class="fas fa-box-open"></i>
                    <p class="name"><?php echo $fat['quantidade'] ?> Pontos</p>
                    <p class="price"><span>R$</span> <?php echo $formatado = number_format($fat['valor'], 2,",",","); ?></p>
                  </div>
                </div>
              </div>
              <div class="col-md-5" style="overflow:hidden; height:420px;">
                <div class="demo2 text-center" style="height: 380px;">
                  <p class="name">Checkout</p>
                  <span style="color: green"><?php echo $success ?></span>
                  <span style="color: red"><?php echo $error ?></span>
                  <form method="POST">
                  <input type="text" name="cupom" placeholder="Cupom de Desconto" style="text-transform: uppercase"> <button class='sbuto' name="attcupom" type="submit">Validar Cupom</button>
                  </form>
                  <br>
                  <p class="price"><span>Valor final:</span> <?php echo $formatado = number_format($valor, 2,",",","); ?></p>
                  <form method="POST">
                  <button class="btn btn-success" name="buyCoins" type="submit">Pagar</button>
                  </form>
                  <?php
                  if(isset($_POST['buyCoins'])){
                  $ref = $_GET['id'];
                  echo "<script>location.href='pagar.php?id=$ref';</script>";
                  }
                  ?>
                </div>
                </div>
            </div>
            </div>
          </div>
        </section>

        <div class="footer" style="margin-top: 20px">
            <p class="copy">Grand Theft Auto é uma marca registrada Rockstar Games e não vinculada a este site.</p>
            <p class="enterprise">Copyright © 2022 - <span>NotryTv</span></p>

            
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    document.onkeydown = function(e) {
  if(event.keyCode == 123) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
  }
}
  </script>
  <script>
    function myFunction() {
      alert("Site protegido!");
      return false
    }
    </script>
  <script>
    $(".number").counterUp({
      time: 1000
    });
  </script>
</body>
</html>