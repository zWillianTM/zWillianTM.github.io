<?php
session_start();
require('connect.php');

if (!isset($_COOKIE['hash'])) {
    header('Location: login.php');
}

$queryUser = mysqli_query($conn, "SELECT * FROM accounts");
$arrU = mysqli_fetch_assoc($queryUser);
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
              <p class="name"><?php echo $arrU['user'] ?> <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></p>
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
         <li class="link active">
          <a href="faturas.php"><i class="far fa-edit"></i> Faturas</a>
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
                  Total Gasto
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
      <p class="title">Minhas Faturas</p>
      <div class="container">
        <div class="row">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Status</th>
                <th scope="col">Valor</th>
              </tr>
            </thead>
            <tbody>
            <?php
                    $counter = 0;
                    $hash = $_COOKIE['hash'];
                    $queryUser = mysqli_query($conn, "SELECT * FROM accounts WHERE  hash = '$hash'");
                    $arrU = mysqli_fetch_assoc($queryUser);
                    $user = $arrU['user'];
                    $query222 = mysqli_query($conn,"SELECT * FROM faturas WHERE user='$user'");
                    while ($rows = mysqli_fetch_array($query222)) {
                    $counter = $counter +1
                    ?>
                        <tr>
                            <?php
                                echo '<th scope="row">#'.$counter.'</th>';
                                echo '<td>'.$rows['ref'].'</td>';
                                echo '<td>PV</td>';
                                echo '<td>'.$rows['valor'].'</td>';
                                if($rows['status'] == 'Pendente'){
                                  echo '<td style="color: yellow">'.$rows['status'].'</td>';
                                }else{
                                  if($rows['status'] == 'Aprovado'){
                                    echo '<td style="color: green">'.$rows['status'].'</td>';
                                  }
                                }
                                echo '<td>R$'.$rows['valor'].',00</td>'
                            ?>
                        </tr>
                    <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

        
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