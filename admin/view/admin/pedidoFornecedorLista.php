<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once CONTROLLERPATH . "/controlUsuario.php";
include_once MODELPATH . "/usuario.php";
include_once CONTROLLERPATH . "/seguranca.php";
include_once CONTROLLERPATH . "/controlCategoria.php";
include_once MODELPATH . "/categoria.php";
include_once CONTROLLERPATH."/controlTipoFornecedor.php";
include_once MODELPATH."/tipo_fornecedor.php";
$_SESSION['permissaoPagina'] = 0;
protegePagina();
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controltipoFornecedor = new controlerTipoFornecedor($_SG['link']);
$tipo_fornecedores = $controltipoFornecedor->selectAll();

//usado para coloração customizada da página selecionada na navbar
$arquivo_pai = basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include VIEWPATH . "/cabecalho.html" ?>
</head>

<body>

    <?php include_once "./header.php" ?>
    
    <div class="container-fluid">
            <div class="searchbar">
                    <div class="col-md-2"> 
                        <label>Fornecedor: </label>
                        <input id="pesquisa" class="form-control" type="text" placeholder="Nome para pesquisa">
                    </div>
                    <div class="col-md-2"> 
                        <label>Tipo do fornecedor: </label>
                        <select class="form-control" name="tipoFornecedor" id="tipoFornecedor">
                            <option value="0">Todos</option>
                                    <?php
                                        foreach($tipo_fornecedores as $tipo_fornecedor){
                                            if($tipo_fornecedor->getFlag_ativo() == 1) { ?>
                                                <option value="<?= $tipo_fornecedor->getPkId(); ?>" > <?= $tipo_fornecedor->getNome() ?> </option>
                                        <?php }
                                        }?>
                                </select>
                    </div>
                        
                    <div class="col-md-2"> 
                        <label>Data do Pedido Inicio: </label>
                        <input id="dt_ped_inicio" name="dt_ped_inicio" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
                    <div class="col-md-2"> 
                        <label>Data do Pedido Fim: </label>
                        <input id="dt_ped_fim" name="dt_ped_fim" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
                    <div class="col-md-2"> 
                        <label>Data Vencimento Inicio: </label>
                        <input id="dt_venc_inicio" name="dt_venc_inicio" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
                    <div class="col-md-2"> 
                        <label>Data Vencimento Fim: </label>
                        <input id="dt_venc_fim" name="dt_venc_fim" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
                    <div class="col-md-2">
                        <button id="printCardapio" style="margin-top:25px" type="button" class="btn btn-kionux" data-toggle="modal" data-target="#printMenuModal">
                            <span class="glyphicon glyphicon-file" aria-hidden="true"></span> Geração de Relatório
                        </button>
                    </div>
            </div>
        <div class="row">
            <div class="col-lg-12" id="tabela-pedidoFornecedor">
                <?php include "../../ajax/pedidoFornecedor-tabela.php"; ?>
            </div>
        </div>
    </div>

    <?php include VIEWPATH . "/rodape.php" ?>

    <!-- Modal impressão -->
    <div class="modal fade" id="printMenuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h4 style="text-align:center;" class="modal-title" id="myModalLabel">
                        <i class='fas fa-info-circle'></i>&nbsp;Relatório a ser Impresso.
                    </h4>

                    <div>
                        <button class="btn btn-kionux" data-dismiss="modal">Voltar</button>

                        <button id="printCardapioModal" type="button" class="btn btn-kionux" onclick="printDiv('#tabelaModal')" >
                            <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
                        </button>
                    </div>
                
                </div>
                <div class="container-fluid">
            <div class="searchbar">
                    <div class="col-md-2"> 
                        <label>Filtro por nome do fornecedor: </label>
                        <input id="pesquisaModal" class="form-control" type="text" placeholder="Nome para pesquisa">
                    </div>
                    <div class="col-md-2"> 
                        <label>Tipo do fornecedor: </label>
                        <select class="form-control" name="tipoFornecedorModal" id="tipoFornecedorModal">
                            <option value="0">Todos</option>
                                    <?php
                                        foreach($tipo_fornecedores as $tipo_fornecedor){
                                            if($tipo_fornecedor->getFlag_ativo() == 1) { ?>
                                                <option value="<?= $tipo_fornecedor->getPkId(); ?>" > <?= $tipo_fornecedor->getNome() ?> </option>
                                        <?php }
                                        }?>
                                </select>
                    </div>
                        
                    <div class="col-md-2"> 
                        <label>Data do Pedido Inicio: </label>
                        <input id="dt_inicioModal" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
                    <div class="col-md-2"> 
                        <label>Data do Pedido Fim: </label>
                        <input id="dt_fimModal" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
                    <div class="col-md-2"> 
                        <label>Data Vencimento Inicio: </label>
                        <input id="dt_modal_venc_inicio" name="dt_modal_venc_inicio" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
                    <div class="col-md-2"> 
                        <label>Data Vencimento Fim: </label>
                        <input id="dt_modal_venc_fim" name="dt_modal_venc_fim" class="form-control" type="date" placeholder="01/01/2000">
                    </div>
            </div>
        <div class="row">
            <div class="col-lg-12" id="tabelaModal">
                <?php include "../../ajax/imprimirRelatorio.php"; ?>
            </div>
        </div>
    </div>
			</div>
		</div>
    </div>

    <script src="../../js/alert.js"></script>
    <script type="text/javascript">
        function removeCategoria(pedidoFornecedor, icone) {
            msgConfirmacao('Confirmação', 'Deseja Realmente remover o pedido?',
                function(linha) {
                    
                    var url = '../../ajax/excluir-pedidoFornecedor.php?categoria=' + pedidoFornecedor;
                    
                    $.get(url, function(dataReturn) {
                        if (dataReturn > 0) {
                            msgGenerico("Excluir!", "Pedido excluído com sucesso!", 1, function() {});
                            $("#status" + pedidoFornecedor).remove();
                        } else {
                            msgGenerico("Erro!", "Não foi possível excluir o pedido!", 2, function() {});
                        }
                    });
                },
                function() {}
            );
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

        //Filtro Tudo (Fora da modal)
        $('#pesquisa, #tipoFornecedor, #dt_ped_inicio, #dt_ped_fim, #dt_venc_inicio, #dt_venc_fim').on('change paste keyup', function(){
            var nome = $("#pesquisa").val();
            var tipoFornecedor = $("#tipoFornecedor").val();
            var dt_ped_inicio = $("#dt_ped_inicio").val();
            var dt_ped_fim = $("#dt_ped_fim").val();
            var dt_venc_ini = $("#dt_venc_inicio").val();
            var dt_venc_fim = $("#dt_venc_fim").val();
            
            var url = '../../ajax/pedidoFornecedor-tabela.php';
            
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome, tipoFornecedor:tipoFornecedor, dt_ped_inicio:dt_ped_inicio, dt_ped_fim:dt_ped_fim, dt_venc_ini:dt_venc_ini, dt_venc_fim:dt_venc_fim},

                success:function(res){
                    $("#tabela-pedidoFornecedor").html(res);
                }
            });
        });
        
        //Filtro do Modal
        $('#pesquisaModal, #tipoFornecedorModal, #dt_inicioModal, #dt_fimModal, #dt_modal_venc_inicio, #dt_modal_venc_fim').on('change paste keyup', function(){
                var nome = $("#pesquisaModal").val();
                var tipoFornecedor = $("#tipoFornecedorModal").val();
                var dt_inicio = $("#dt_inicioModal").val();
                var dt_fim = $("#dt_fimModal").val();
                var dt_venc_ini = $("#dt_modal_venc_inicio").val();
                var dt_venc_fim = $("#dt_modal_venc_fim").val();
                
                var url = '../../ajax/imprimirRelatorio.php';
            $.ajax({
                type: 'POST',

                url: url,

                data: {nome:nome, tipoFornecedor:tipoFornecedor, dt_inicio:dt_inicio, dt_fim:dt_fim, dt_venc_ini:dt_venc_ini, dt_venc_fim:dt_venc_fim},

                success:function(res){
                    $("#tabelaModal").html(res);
                }
            });
        });

    </script>
</body>
</html>