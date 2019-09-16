<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlEvento.php";
    include_once MODELPATH."/evento.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página seleciona na navbar
    $father_filename = basename(__FILE__, '.php');
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
                <?php include "../../ajax/evento-tabela.php"; ?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.html" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeEvento(evento,foto){
            msgConfirmacao('Confirmação','Deseja Realmente remover o evento?',
                function(linha){
                    var url ='../../ajax/excluir-evento.php?evento='+evento+'&foto='+foto;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Evento excluído com sucesso!",1,function(){});
                            $("#status"+evento).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir o evento!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }
    </script>
</body>
</html>