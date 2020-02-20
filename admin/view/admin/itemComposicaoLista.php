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
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/itemComposicao-tabela.php";?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.html" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
       function removeItemComposicao(cod){
            msgConfirmacao('Confirmação','Deseja Realmente remover o item de composicao ?',
                function(linha){
                    // alert(cod);
                    var url ="../../ajax/excluir-item-composicao.php?cod="+cod;
                    $.get(url, function(dataReturn) {
                        if (dataReturn == 1) {
                            msgGenerico("Erro!","Não foi possível excluir o item da composição!",2,function(){});
                        }else{
                            msgGenerico("Excluir!","Item da composição excluido com sucesso!",1,function(){});
                            $("#status"+cod).remove();
                            
                        }
                    });  
                },
                function(){}
            );
        }
    </script>
</body>
</html>