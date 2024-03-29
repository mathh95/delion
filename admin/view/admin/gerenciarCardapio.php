<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlProduto.php";
    include_once CONTROLLERPATH."/controlCategoria.php";
    include_once MODELPATH."/produto.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
    $controleCategoria = new controlerCategoria($_SG['link']);
    $categorias = $controleCategoria->selectAll();

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<style>
    .active{
        background-color: #ee6938 !important;
        border-color: #ee6938 !important;
    }
    .active > .badge{
        color: black !important;
    }
</style>

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
                    <td style='text-align: center;' name='status'><button type='button' class='btn btn-kionux' onclick="pausarProducao();"><i class='fa fa-pause'></i> Parar Produção</button></td>
                </div>
                <div class="mini-divs">
                    <button id="reordenar" style="margin-top:25px;" type="button" class="btn btn-kionux" data-toggle="modal" data-target="#ordenacaoModal">
                        <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span> Reordenar itens
                    </button>
                </div>
                <div class="mini-divs">
                    <button id="printCardapio" style="margin-top:25px;" type="button" class="btn btn-kionux" data-toggle="modal" data-target="#printMenuModal">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Cardápio
                    </button>
                </div>

            </div>

            <div class="row">
                <div id="tabela-cardapio" class="col-lg-12">
                    <?php include "../../ajax/gerenciarCardapioTabela.php";?>
                </div>
            </div>

            
    </div>
    <?php include VIEWPATH."/rodape.php" ?>

    <!-- Modal Ordenação -->
	<div class="modal fade" id="ordenacaoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                    <h4 style="text-align:center;" class="modal-title" id="myModalLabel">
                        <i class='fas fa-info-circle'></i>&nbsp;Ordenação visível para o cliente.
                    </h4>
				</div>
				<div style="height:400px; overflow-y: auto;" class="modal-body">
                    <div class="row" style="margin-left:0px!important">
                        <?php include "../../ajax/ordenarCardapio.php";?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-kionux" data-dismiss="modal">Voltar</button>
                    
                    <button type="submit" class="btn btn-kionux" id="salvar_ordenacao">Salvar</button>
                </div>
			</div>
		</div>
    </div>

    <!-- Modal impressão -->
    <div class="modal fade" id="printMenuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h4 style="text-align:center;" class="modal-title" id="myModalLabel">
                        <i class='fas fa-info-circle'></i>&nbsp;Cardápio a ser impresso.
                    </h4>

                    <div>
                        <button class="btn btn-kionux" data-dismiss="modal">Voltar</button>

                        <button id="printCardapioModal" type="button" class="btn btn-kionux" onclick="printDiv('#printModalCardapio')" >
                            <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
                        </button>
                    </div>
                    <div class="searchbar">
                        <div class="mini-divs"> 
                        <label> Selecionar Impressão </label>
                            <select class="form-control" id="flag_busca">
                                <option value='0'>ITENS ATIVOS</option>
                                <option value='1'>TODOS OS ITENS</option>
                            </select>
                        </div>
                    </div>
                </div>

				<div style="height:400px; overflow-y: auto;" class="modal-body" id="printModalCardapio">
                    <div class="row" style="margin-left:0px!important">
                        <?php include "../../ajax/imprimirCardapio.php";?>
                    </div>
                </div>
			</div>
		</div>
    </div>

    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        //Pausa um item isoladamente
        function pausarItem(produto,status){
            msgConfirmacao('Confirmação','Deseja realmente pausar o item?',
                function(linha){
                    var url ='../../ajax/desativa-servindo.php?produto='+produto;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Pausar!","Item do cardápio pausado com sucesso!",1,function(){});
                        }else{
                            msgGenerico("Erro!","Não foi possível pausar o item!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }

        //Ativa um item isoladamente
        function ativarItem(produto,status){
            msgConfirmacao('Confirmação','Deseja realmente ativar o item?',
                function(linha){
                    var url ='../../ajax/ativar-servindo.php?produto='+produto;
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Ativo!","Item do cardápio ativado com sucesso!",1,function(){});
                        }else{
                            msgGenerico("Erro!","Não foi possível ativar o item!",2,function(){});
                        }
                    });  
                },
                function(){}
            );
        }


        function pausarProducao(){
            var txtPesquisa = document.getElementById("pesquisa").value;
                msgConfirmacao('Confirmação','Deseja realmente pausar os itens listados?',
                    function(linha){
                        var url ='../../ajax/desativar-servindo.php?nome='+txtPesquisa;
                        $.get(url, function(dataReturn) {
                            console.log(dataReturn);
                            if(dataReturn > 0) {
                                msgGenerico("Erro!","Itens não foram pausados!",1,function(){});
                            }else{
                                msgRedireciona('Pausados!','Itens pausados com sucesso!',1,'/admin/view/admin/gerenciarCardapio.php');
                            }
                        });
                    },
                    function(){}
                );
            // alert(txtPesquisa);
        }

        function printDiv(elem){
                renderMe($(elem).html());
            }

            function renderMe(data) {
                // console.log(data);
                var mywindow = window.open('', 'invoice-box', 'height=1000,width=750');
                mywindow.document.write('<html><head><title>Cardápio</title>');
                mywindow.document.write('<link rel="stylesheet" href="printstyle.css" type="text/css" style="height=750,width=750"/>');
                mywindow.document.write('</head><body >');
                mywindow.document.write(data);
                mywindow.document.write('</body></html>');
                mywindow.document.close();

                mywindow.onload=function(){
                    mywindow.focus();
                    mywindow.print();
                };
            }
         

        
        $('#pesquisa,#producao').on('change paste keyup', function(){
            var filtro = $("#pesquisa").val();
            var producao = $("#producao").val();
            var url = '../../ajax/gerenciarCardapioTabela.php';
            $.ajax({
                type: 'POST',
                url: url,
                data: {filtro:filtro, producao:producao},

                success:function(res){
                    $("#tabela-cardapio").html(res);
                }
            });
        });

        // $('#pesquisa,#producao').on('change', function(){
        //     var filtro = $("#pesquisa").val();
        //     var producao = $("#producao").val();
        //     var url = '../../ajax/gerenciarCardapioTabela.php';
        //     $.ajax({
        //         type: 'POST',

        //         url: url,

        //         data: {filtro:filtro, producao:producao},

        //         success:function(res){
        //             $("#tabela-cardapio").html(res);
        //         }
        //     });
        // });

        //Reload Page 
        function doRefresh(){
        //Verificacao se a pagina é nula,
            $("#tabela-cardapio").load("../../ajax/gerenciarCardapioTabela.php");
        }

        //Da reload na tabela-cardapio
        window.setInterval(function(){
            var verifica = $('body').hasClass('modal-open'); //Verifica se a modal está aberta
            if(verifica == false){ 
                doRefresh();
            }
        }, 60000);


    </script>

    <!-- Ordenação da Categoria -->
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script type="text/javascript">

        var order_categorias = [];
        var order_itens = [];

        $(document).on("click", "#reordenar", function(){

            // Selecionar Categoria
            $('.categoria').on('click', function(){
                var $this = $(this);
                var cod_categoria = $this.data('id');

                // cor
                $('.active').removeClass('active');
                $this.toggleClass('active');

                // display lista de itens p/ categoria selecionada
                $('.item').hide();
                $("[data-cod_categoria='"+cod_categoria+"']").show();

                // call 
                // ($this, $categoria, $cod_cardapio)

            });

            //Sortable Order
            var l_categorias = Sortable.create(list_categorias, {
                handle: '.glyphicon-menu-hamburger',
                animation: 150,
                onUpdate: function() {
                    order_categorias = l_categorias.toArray();
                    order_categorias.shift();
                }
            });
            var l_itens = Sortable.create(list_itens, {
                handle: '.glyphicon-menu-hamburger',
                animation: 150,
                onUpdate: function() {
                    order_itens = l_itens.toArray();
                    order_itens.shift();
                }
            });

            $(document).on("click", "#salvar_ordenacao", function(){

                $.ajax({
                    type: "POST",
                    data: {categorias : order_categorias, itens : order_itens},
                    url: "../../controler/alteraOrdemCardapio.php",
                    success: function(msg){
                        console.log(msg);
                        if(msg.indexOf("sucesso") >= 0){
                            msgRedireciona('Alteração Realizada!','Reordenação feita com sucesso!',1,'./gerenciarCardapio.php');
                        }
                    },
                    error: function(err){
                        console.log(err);
                    }
                });
                
            });

        });

        $('#flag_busca').on('change', function(){
            var flag_busca = $("#flag_busca").val();
            var url = '../../ajax/imprimirCardapio.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {flag_busca:flag_busca},

                success:function(res){
                    $("#printModalCardapio").html(res);
                }
            });
        });

    </script>

</body>
</html>