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
        <div class="row">
            <div class="col-lg-12" id="tabela-cliente">
                <?php include "../../ajax/formaPgt-tabela.php"; ?>
            </div>
        </div>
    </div>


    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeFormaPgt(formaPgt){
            msgConfirmacao('Confirmação','Deseja Realmente remover a Forma de Pagamento?',
                function(linha){
                    var url ='../../ajax/excluir-formaPgt.php?cod='+formaPgt;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Forma de pagamento excluida com sucesso!",1,function(){});
                            $("#status"+formaPgt).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir a Forma de Pagamento!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }
    </script>


</body>

<?php include VIEWPATH."/rodape.html" ?>

</html>