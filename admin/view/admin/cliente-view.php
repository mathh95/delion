
<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once HOMEPATH."home/controler/controlCliente.php";
    include_once MODELPATH."/usuario.php";
    include_once MODELPATH."/cliente.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
</head>
<body>
    
    <?php include_once "./header.php" ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/cliente-enderecos.php"; ?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.php" ?>
</body>
</html>