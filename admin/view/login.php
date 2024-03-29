<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

session_start();

if(isset($_SESSION['usuarioID'])){
    header("Location: ../sistema.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex" />
    <title>Área Administrativa</title>
    <link href="../vendor/bootstrap3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../dist/css/normalize.css">
    <link rel="stylesheet" href="../dist/css/main.css">
</head>
<body>
    <div class="container-fluid">
        <div class="center-block login-box">
            <img src="../img/Kionux_1.jpg" alt="" />
            <h1>Área Administrativa Delion Café</h1>
            <form class="form-horizontal" action="../controler/validaAcesso.php" method="post">
                <div class="login-fields center-block;">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" placeholder="Usuário" name="usuario" value="" required  type="text" autofocus>
                  </div>
                  <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input class="form-control" placeholder="Senha" name="senha" value="" required  type="password">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-kionux btn-k-big"><i class="glyphicon glyphicon-hand-right"></i> &nbsp;Entrar</button>
                </div>
                <!-- <div class="form-group">
                <label for="user"><img src="../img/person.png" alt=""/></label>
                <input type="text" name="user" placeholder="Usuário" required>
              </div>
              <div class="form-group">
              <label for="password"><img src="../img/cadeado.png" alt="" /></label>
              <input type="password" name="password" placeholder="Senha" required>
            </div> -->
            </form>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap3/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>
</html>