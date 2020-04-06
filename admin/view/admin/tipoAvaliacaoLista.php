<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlTipoAvaliacao.php";
    include_once MODELPATH."/tipo_avaliacao.php";
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
                <?php include "../../ajax/tipo-avaliacao-tabela.php";?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.php" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
       function removeTipoAvaliacao(cod){
            msgConfirmacao('Confirmação','Deseja Realmente remover o tipo avaliação ?',
                function(linha){
                    alert(cod);
                    var url ="../../ajax/excluir-tipo-avaliacao.php?cod="+cod;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Tipo avaliação excluido com sucesso!",1,function(){});
                            $("#status"+cod).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir o tipo avaliação!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }
    </script>
</body>
</html>