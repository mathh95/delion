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
                        <label>Filtro por nome do cliente: </label>
                        <input id="pesquisa" class="form-control" type="text" placeholder="Nome para pesquisa">
                    </div>
                    <div class="mini-divs"> 
                        <label>Menor valor do pedido: </label>
                        <input id="menor" class="form-control" type="number" placeholder="">
                    </div>
                        
                    <div class="mini-divs"> 
                        <label>Maior valor do pedido: </label>
                        <input id="maior" class="form-control" type="number" placeholder="">
                    </div>
                    <div class="medium-divs"> 
                        <label>Filtro por rua, CEP ou número do endereço: </label>
                        <input id="endereco" class="form-control" type="text" placeholder="Rua, CEP ou número para pesquisa">
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="tabela-pedido">
                    <?php include "../../ajax/pedido-tabela.php"; ?>
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

            $('#pesquisa, #menor, #maior, #endereco').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var menor = $("#menor").val();
            var maior = $("#maior").val();
            var endereco = $("#endereco").val();
            if (menor == ''){
                menor = 0;
            }
            if ( maior == ''){
                maior = 999999;
            }
            var url = '../../ajax/pedido-tabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome, menor:menor, maior:maior, endereco:endereco},

                success:function(res){
                    $("#tabela-pedido").html(res);
                }
            });
        });
        </script>
    </body>
    </html>