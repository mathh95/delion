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
                <button id="reordenar" style="margin-top:25px;" type="button" class="btn btn-kionux" data-toggle="modal" data-target="#ordenacaoModal">
                    <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span> Reordenar itens
                </button>
            </div>

            <div class="row">
                <div id="tabela-cardapio" class="col-lg-12">
                    <?php include "../../ajax/gerenciarCardapioTabela.php";?>
                </div>
            </div>
    </div>

    <?php include VIEWPATH."/rodape.html" ?>

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
        
        $('#pesquisa').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var url = '../../ajax/gerenciarCardapioTabela.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome},

                success:function(res){
                    $("#tabela-cardapio").html(res);
                }
            });
        });
    </script>

    <!-- Ordenação da Categoria -->
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script type="text/javascript">
        $(document).on("click", "#reordenar", function(){
            // List with handle
            var l_categorias = Sortable.create(list_categorias, {
                handle: '.glyphicon-menu-hamburger',
                animation: 150,
                onUpdate: function() {
                    var order = l_categorias.toArray();
                    console.log(order);
                }
            });
            // List with handle
            var l_itens = Sortable.create(list_itens, {
                handle: '.glyphicon-menu-hamburger',
                animation: 150,
                onUpdate: function() {
                    var order = l_itens.toArray();
                    console.log(order);
                }
            });
        });
    </script>

</body>
</html>