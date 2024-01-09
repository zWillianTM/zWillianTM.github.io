<?php
    include "connect.php";
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
                            <a class="nav-link active" href="index.php">Ínicio</a>
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

        <div class="content">
            <div class="container-md">
                <div class="content-content">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="title">Diversão <span>Garantida</span>!</p>
                            <p class="desc">Em nosso servidor a diversão é
                                garantida, nossa equipe garante sua jogabilidade
                                100%, trabalhamos para deixar seu RolePlay mais
                                leve!</p>
                            <a href="mtasa://123.456.17.104:22003" class="btn">Jogar Agora!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="services">
            <div class="pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="item">
                                <i class='bx bxs-shield-alt-2'></i>
                                <h6>Segurança</h6>
                                <p>Trabalhamos com os métodos de pagamento
                                    disponibilizados pelo MercadoPago, sendo
                                    assim, possuindo a total segurança posta por
                                    ele!</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item">
                                <i class='bx bxs-bolt'></i>
                                <h6>Agilicade</h6>
                                <p>Nossa entrega é super rápida! O seu produto
                                    será entregue em até 48 horas após a compra,
                                    porém o tempo médido é de 5 minutos!</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item">
                                <i class='bx bx-message-square-detail'></i>
                                <h6>Melhor Suporte</h6>
                                <p>Nosso objetivo é oferecer a melhor
                                    experiência ao cliente. Portanto, o suporte
                                    é a parte mais importante da empresa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="avaliações">
        <div class="container text-center">
              <p class="title">Nossa equipe!</p>
              <p class="stitle">Aqui está a nossa equipe que faz a loja acontecer!</p>
              <div class="row my-5">
                <div class="col-md-6">
                  <div class="card">
                    <img src="app/img/hyze.png">
                    <p class="name">Notry Tv</p>
                    <p class="tags"><span class="badge bg-primary">Fundador</span> <span class="badge bg-primary">Desenvolvedor</span></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <img src="app/img/hyze.png">
                    <p class="name">Notry Tv</p>
                    <p class="tags"><span class="badge bg-primary">Fundador</span> <span class="badge bg-primary">Desenvolvedor</span></p>
                  </div>
                </div>
              </div>
          </div>
      </section>

        <div class="footer">
            <p class="copy">Grand Theft Auto é uma marca registrada Rockstar Games e não vinculada a este site.</p>
            <p class="enterprise">Copyright © 2022 - <span>BCCRolePlay</span></p>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>