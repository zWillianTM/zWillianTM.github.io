<?php
  include "connect.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Vitin">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app/css/style.css">
    <link rel='icon' href='app/img/logo.png' type='image/png'>
    <title>Termos</title>
</head>
<body>
  <section class="apresentation">
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
                            <a class="nav-link active" href="termos.php">Termos</a>
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
              <section id="terms" class="my-7" style="margin-top: 8rem;">
                <div class="container">
                  <div class="row text-start">
                    <h2 class="title">Termos & Condições</h2>
                    <p>É de total responsabilidade do cliente verificar periodicamente se há alterações nesses termos!</p>
                    <ul>
                      <li class="say5">
                        <p><span>1 - Reembolso e Trocas:</span> <br>
                        <b>1.1</b> - Nós da loja TM STORE damos reembolso somente se: O resource ainda possuir nossa garantia, for impossível corrigir o bug do resource e impossível trocar o resource por outro de mesmo valor.<br>
                        <b>1.2</b> - A troca só é feita se for impossível corrigir o bug do resource e ele possuir nossa garantia. A troca só é feita por outro resource de mesmo valor.<br>
                        </p>
                      </li>
                      <li>
                        <p><span>2 - Desacordo com pedido:</span> <br>
                        <b>2.1</b> - Se acontecer de o resource não estiver como prometido pela loja, nós da loja TM STORE iremos arrumá-lo, desde que ele tenha nossa garantia. Se for impossível arrumar o resource, trocaremos esse resource por outro de mesmo valor. Se for impossível a troca, dai sim reembolsaremos o cliente.</p>
                      </li>
                      <li>
                        <p><span>3 - Estado do produto:</span> <br>
                        <b>3.1</b> - Após comprar um resource do site, o cliente está ciente de que está comprando no estado em que ele se encontra. Caso o cliente queira alguma alteração, ele será cobrado pela loja. Essa alteração fica a critério da loja se vai fazer ou não. O cliente não será cobrado se a alteração for recusada pela loja.</p>
                      </li>
                      <li>
                        <p><span>4 - Prazo de entrega:</span> <br>
                        <b>4.1</b> - Se a forma de pagamento for com Mercado Pago, o prazo pode variar de IMEDIATO a 24 horas úteis.<br>
                        <b>4.2</b> - Se a forma de pagamento for com Paypal o prazo pode variar de IMEDIATO a 24 horas úteis.<br>
                        <b>4.3</b> - Se a forma de pagamento for com Pix, o prazo pode variar de IMEDIATO a 48 horas úteis.<br>
                        <b>4.4</b> - Se a forma de pagamento for com boleto, o prazo pode variar de IMEDIATO a 72 horas úteis.<br>
                        <b>4.5</b> - O prazo de entrega só começa a contar após o pagamento entrar em nossa conta.<br>
                        <b>4.6</b> - Esses prazos não se aplicam aos resources de encomendas, pois estes podem variar para além dos prazos acima estabelecidos.</p>
                      </li>
                      <li>
                        <p><span>5 - Pagamento:</span> <br>
                        <b>5.1</b> - Aceitamos 4 formas de pagamento no momento: Mercado Pago, Pix, Paypal e Boleto<br>
                        <b>5.2</b> - Se for pego enviando comprovantes falsos, o cliente será banido da loja e perderá o acesso aos resources contidos nela sem direito a reembolso, trocas e nem qualquer serviço adicional.</p>
                      </li>
                      <li>
                        <p><span>6 - Garantia:</span> <br>
                        <b>6.1</b> - Os resources comprados em nossa loja possuem nossa garantia por tempo indeterminado. Os resources encomendados possuem nossa garantia válida por até 3 meses após a entrega do respectivo resource.<br>
                        <b>6.2</b> - O cliente possui a garantia de que iremos corrigir qualquer bug do resource se ele possuir nossa garantia.<br>
                        <b>6.3</b> - Se o cliente fizer alterações no resource, este deixa de ter nossa garantia e não poderá ser reembolsado, trocado e nem corrigido.<br>
                        <b>6.4</b> - Somente alterações feitas pela loja não violam nossa garantia.</p>
                      </li>
                      <li>
                        <p><span>7 - Violação de Conduta:</span><br>
                        <b>7.1</b> - Revender ou distribuir os resources de nossa loja sem nossa autorização, sendo o resource por encomenda ou não, é expressamente proibido. Se comprovado, o cliente será banido de nossa loja e perderá o acesso aos resources contidos nela sem direito a reembolso, trocas e nem qualquer serviço adicional. O cliente pode inclusive responder judicialmente por tal violação.<br>
                        <b>7.2</b> - Qualquer tentativa de calote também resultará no banimento do cliente em nossa loja, fazendo com que ele perca o acesso aos resources contidos nela.</p><br>
                      </li>
                      <p style="font-weight: 600; color:#efefef;">Ao comprar qualquer produto desta loja você está automaticamente concordando com os termos de uso do site! <br><br>Última atualização dos termos: (15/10/2021)</p>                     
                      </ul>  
                  </div>
                </div>
              </section>

              <div class="footer" style="margin-top: 20px">
            <p class="copy">Grand Theft Auto é uma marca registrada Rockstar Games e não vinculada a este site.</p>
            <p class="enterprise">Copyright © 2022 - <span>NotryTv</span></p>

            
        </div>
        </section>
</body>
</html>