<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once HOMEPATH."home/controler/controlCombo.php";
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
                <div class="mini-divs"> 
                    <label>Valor mínimo do combo </label>
                    <?php $controlCombo= new controlerCombo($_SG['link']);
                          $minimo = $controlCombo->selectMinCombo();
                    ?>
                    <input id="combo" class="form-control" type="number" required placeholder="Valor mínimo de produtos combo" value="<?php echo $minimo; ?>">
                </div>
                <div class="medium-divs" style="padding-top:25px">
                    <button class="btn btn-kionux" onClick="alterarMinimo()"> Salvar </button>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/combo-tabela.php"; ?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.html" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function alterarStatus(pedido,status){
            msgConfirmacao('Confirmação','Deseja Realmente alterar o status do pedido?',
                function(linha){
                    var url ='../../ajax/alterar-pedido.php?pedido='+pedido+'&status='+status;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoLista.php" );
                        }else{
                            msgGenerico("Erro!","Não foi possível alterar o status do pedido!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }
        function alterarMinimo(){
            var minimo = $("#combo").val();
            var url = '../../controler/alteraMinimoCombo.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {minimo:minimo},

                success:function(res){
                    if (res > 0) {
                            msgRedireciona("Sucesso!","Alterado!",1,"../../view/admin/comboLista.php" );
                        }else{
                            msgGenerico("Erro!","Não foi possível alterar!",2,function(){});
                        }
                }
            });
        }
    </script>
</body>
</html>