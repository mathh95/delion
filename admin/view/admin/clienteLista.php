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
                    <label>Filtro por nome, email ou telefone do cliente: </label>
                    <input id="pesquisa" class="form-control" type="text" required placeholder="Nome, email ou telefone para pesquisa">
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="tabela-cliente">
                <?php include "../../ajax/cliente-tabela.php"; ?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.html" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeCliente(cliente){
            msgConfirmacao('Confirmação','Deseja Realmente remover o cliente?',
                function(linha){
                    var url ='../../ajax/excluir-cliente.php?cliente='+cliente;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Cliente excluído com sucesso!",1,function(){});
                            $("#status"+cliente).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir o cliente!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }

        $('#pesquisa').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var url = '../../ajax/cliente-tabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome},

                success:function(res){
                    $("#tabela-cliente").html(res);
                }
            });
        });
    </script>
</body>
</html>