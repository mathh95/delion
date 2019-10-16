<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlCardapio.php";
    include_once CONTROLLERPATH."/controlCategoria.php";
    include_once MODELPATH."/cardapio.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
    $controleCategoria = new controlerCategoria($_SG['link']);
    $categorias = $controleCategoria->selectAll();

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    
    <?php include_once "./header.php" ?>

    <!-- Alterar para fazer a busca apenas no campo descrição -->

    <div class="container-fluid">
        <div class="searchbar">
                <div class="mini-divs"> 
                    <label>Filtro por ingrediente: </label>
                    <input id="pesquisa" class="form-control" type="text" required placeholder="Digite o ingrediente">
                </div>

                <div class="mini-divs"> 
                    <label> Em produção </label>
                    <select class="form-control" id="producao">
                        <option value=''>TODOS</option>
                        <option value='0'>PAUSADO</option>
                        <option value='1'>SERVINDO</option>
                    </select>
                </div>
                <div class="mini-divs"> 
                    <label>Pausar itens listados: </label>
                    <td style='text-align: center;' name='status'><button type='button' class='btn btn-kionux' onclick="getInputValue();"><i class='fa fa-pause'></i> Parar Produção</button></td>
                </div>
            </div>

        </div>
            <div class="row">
                <div id="tabela-cardapio" class="col-lg-12">
                    <?php include "../../ajax/gerenciarCardapioTabela.php";?>
                </div>
            </div>
    </div>
    <!-- Pode remover essa função -->
    <?php include VIEWPATH."/rodape.html" ?>
    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeCardapio(cardapio,foto){
            msgConfirmacao('Confirmação','Deseja Realmente remover o item cardápio?',
                function(linha){
                    var url ='../../ajax/excluir-cardapio.php?cardapio='+cardapio+'&foto='+foto;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!","Item do cardápio excluido com sucesso!",1,function(){});
                            $("#status"+cardapio).remove();
                        }else{
                            msgGenerico("Erro!","Não foi possível excluir a cardapio!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }


        function getInputValue(){
            var txtPesquisa = document.getElementById("pesquisa").value;
                msgConfirmacao('Confirmação','Deseja realmente pausar os itens listados?',
                    function(linha){
                        var url ='../../ajax/pausa-itens.php?nome='+txtPesquisa;
                        $.get(url, function(dataReturn) {
                            if(dataReturn > 0) {
                                msgGenerico("Pausar!","Itens pausados no cardápio com sucesso!",1,function(){});
                            }else{
                                console.log(txtPesquisa);
                            }
                        });
                    },
                    function(){}
                );
            // alert(txtPesquisa);
        }

        
        $('#pesquisa,#producao').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var producao = $("#producao").val();
            var url = '../../ajax/gerenciarCardapioTabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome, producao:producao},

                success:function(res){
                    $("#tabela-cardapio").html(res);
                }
            });
        });

        $('#producao').on('change paste keyup', function(){
            var producao = $("producao").val();
            var url = '../../ajax/gerenciarCardapioTabela.php';
            $ajax({
                type: 'POST',

                url: url,

                data: {producao:producao},

                success:function(res){
                    $("#tabela-cardapio").html(res);
                }
            });
        });

    </script>
</body>
</html>