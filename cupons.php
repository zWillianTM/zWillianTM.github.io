<?php
session_start();
require('connect.php');

if (!isset($_COOKIE['hash'])) {
    header('Location: login.php');
}

$hash = $_COOKIE['hash'];
$queryAdmin = mysqli_query($conn, "SELECT * FROM accounts WHERE hash = '$hash'");
$arrA = mysqli_fetch_assoc($queryAdmin);
if($arrA['adm'] < 1){
    header("Location: ../");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Notry Tv">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app/css/panel.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <link rel='icon' href='app/img/logo.png' type='image/png'>
    <title>Notry Tv</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
  <div class="sidebar col-auto col-md-3 col-xl-2 px-sm-2 px-0">
    <div class="side-top">
      <div class="infos">
        <div class="container">
          <div class="row">
            <div class="col-md-2 text-start">
              <div class="user">
                <i class="far fa-user"></i>
              </div>
            </div>
            <div class="col-md-10 text-start">
              <p class="name"><?php echo $arrA['user'] ?> <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="side-body">
      <ul>
      <li class="link">
          <a href="index.php" class="active"><i class="fas fa-home"></i> Home</a>
        </li>
         <li class="link">
          <a href="admin.php"><i class="far fa-edit"></i> Faturas</a>
         </li>
         <li class="link active">
          <a href="cupons.php"><i class="far fa-solid fa-credit-card"></i> Cupons</a>
         </li>
        </ul>
    </div>
  </div>
  <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
  </div>
  
  <div class="col py-3">
    <div class="stats">
      <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
              <div class="stat">
                <p class="title">
                  Total Pontos Adquiridos
                </p>
                <p class="counters">
                <?php
                  $sql = mysqli_query($conn, "SELECT * FROM total");
                  $result = mysqli_fetch_assoc($sql);
                  $total = $result['pontos'];
                  echo ''.$total.'</p>';
                  ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="stat">
                <p class="title">
                
                </p>
                <p class="counters">
                               </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="stat">
                <p class="title">
                  Total Ganho
                </p>
                <p class="counters">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM total");
                  $result = mysqli_fetch_assoc($sql);
                  $total = $result['valor'];
                  $resultadofinal = number_format($total, 2,",",",");
                  echo '<span>R$</span>'.$resultadofinal.'</p>';
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="scripts">
      <p class="title">Todos cupons <a href="addcupons.php" style="float: right; margin-top: 5px; background: #986FF1; text-decoration: none; border-radius: 5px; font-size: 20px; padding: 0 10px; color: #fff !important; font-weight: 600; margin-right: 15px;">Adicionar Cupom</a></p>
      <div class="container">
        <div class="row">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Código</th>
                <th scope="col">Valor</th>
                <th scope="col">Status</th>
                <th scope="col">Uso</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $queryC = mysqli_query($conn, "SELECT * FROM cupons ORDER BY id DESC");
              while($arrC = mysqli_fetch_assoc($queryC)){
                $style = "white";

                if($arrC['status'] == "false"){
                  $style = '#ee7c59';
                  $title = "Desativado";
                }elseif($arrC['status'] == "true"){
                  $style = 'green';
                  $title = 'Ativado';
                }
                
                  if($arrC['status'] == 'false'){
                  echo '<tr>
                  <th scope="row">'.$arrC['id'].'</th>
                  <td>'.$arrC['cupom'].'</td>
                  <td>-'.$arrC['valor'].'%</td>
                    <td><span style="color: '.$style.'">'.$title.'</span></td>
                  <td>'.$arrC['usos'].'</td>';
                  echo '<td><a href="ativar.php?id='.$arrC['id'].'">Ativar<a/> | <a href="apagar.php?id='.$arrC['id'].'">Apagar</a></td>
                </tr>';
                  }else{
                    if($arrC['status'] == 'true'){
                      echo '<tr>
                  <th scope="row">'.$arrC['id'].'</th>
                  <td>'.$arrC['cupom'].'</td>
                  <td>-'.$arrC['valor'].'%</td>
                    <td><span style="color: '.$style.'">'.$title.'</span></td>
                  <td>'.$arrC['usos'].'</td>';
                  echo '<td><a href="desativar.php?id='.$arrC['id'].'">Desativar</a> | <a href="apagar.php?id='.$arrC['id'].'">Apagar</a></td>
                </tr>';
                    }
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
       
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

</body>
</html>