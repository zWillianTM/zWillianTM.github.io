<?php 
    session_start();
    include('connect.php');
    
    if(isset($_COOKIE['hash'])){
        header('Location: index.php');
    }

    if (isset($_POST['send'])){
        $idmta = $_POST['id_notry'];
        $user = $_POST['user_notry'];
        $email = $_POST['email_notry'];
        $pass = md5($_POST['pass_notry']);
        $cpass = md5($_POST['cpass_notry']);
        $sql = "SELECT * FROM `accounts` WHERE user = '$user'";
        $result = mysqli_query($conn, $sql);
        $verify = mysqli_num_rows($result);
        if($verify < 1){
            if($pass == $cpass){
                $queryUser = mysqli_query($conn, "SELECT * FROM accounts WHERE idmta = '$idmta'");
                $resultmta = mysqli_num_rows($queryUser);
                if($resultmta < 1){
                $hash = generateHash();
                mysqli_query($conn, "INSERT INTO `accounts`(`hash`, `idmta`, `email`, `user`, `pass`, `adm`) VALUES ('$hash','$idmta','$email','$user','$pass','0')");
                mysqli_query($conn, "INSERT INTO `totalclient`(`valor`, `pontos`, `user`) VALUES ('0','0','$user')");
                setcookie("hash", $hash);
                header("location: ../");
                }else{
                    $error = "Este id já está sendo usado!";
                }
            }else{
                $error = "As senhas não são iguais!!";
            }
        }else{
            $error = "Este nome de usuário já esta sendo usado!";
        }
    }else{
        $error = "";
    }
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
                            <a class="nav-link" href="index.php">Ínicio</a>
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

        <div class="login" style="margin-top: 40px">
            <div class="container-md">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="login-content" style="margin-top: 50px;">
                            <h1 class="title">Criar uma conta</h1>
                            <span style="color: red"><?php echo $error ?></span>
                            <form method="POST">
                                <label for="id_notry">ID:</label>
                                <input type="number" name="id_notry" required>

                                <label for="user_notry">Usuário:</label>
                                <input type="text" name="user_notry" required>

                                <label for="email_notry">Email:</label>
                                <input type="email" name="email_notry" required>

                                <label for="pass_hype">Senha:</label>
                                <input type="password" name="pass_notry" required>

                                <label for="cpass_notry">Confirmar Senha:</label>
                                <input type="password" name="cpass_notry" required>

                                <button type="submit" name="send" class="btn">Continuar</button>

                                <p class="singin">Já tem uma conta? <a href="login.php">Fazer login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>