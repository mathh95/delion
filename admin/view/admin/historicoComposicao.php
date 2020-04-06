<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
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
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    
    <?php include_once "./header.php" ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" id="tabela-cliente">
                <?php include "../../ajax/historico-composicao-tabela.php"; ?>
            </div>
        </div>
    </div>


    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removePrecoDeCusto(precoDeCusto){
            msgConfirmacao('Confirmação','Deseja Realmente remover o produto do preço de custo?',
                function(linha){
                    var url ='../../ajax/excluir-precoDeCusto.php?cod='+precoDeCusto;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Preço de custo excluido com sucesso!",1,function(){});
                            $("#status"+precoDeCusto).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir o preço de custo!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }
    </script>


</body>

<?php include VIEWPATH."/rodape.php" ?>

</html>