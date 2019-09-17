<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página seleciona na navbar
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
        <div class="searchbar">
                <div class="medium-divs"> 
                    <label>Pesquise por qualquer campo: </label>
                    <input id="parametro" class="form-control" type="text" required placeholder="Digite aqui para pesquisar em qualquer campo">
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="tabela-endereco">
                <?php include "../../ajax/endereco-tabela.php"; ?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.html" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        $('#parametro').on('change paste keyup', function(){
            var parametro = $("#parametro").val();
            var url = '../../ajax/endereco-tabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {parametro:parametro},

                success:function(res){
                    $("#tabela-endereco").html(res);
                }
            });
        });
    </script>
</body>
</html>