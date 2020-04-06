<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlImagem.php";
    include_once MODELPATH."/imagem.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

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
                <?php include "../../ajax/imagem-tabela.php";?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.php" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeImagem(imagem,foto){
            msgConfirmacao('Confirmação','Deseja Realmente remover a imagem?',
                function(linha){
                    var url ='../../ajax/excluir-imagem.php?imagem='+imagem+'&foto='+foto;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Imagem excluída com sucesso!",1,function(){});
                            $("#status"+imagem).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir o imagem!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }
    </script>
</body>
</html>