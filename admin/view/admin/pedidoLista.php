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
<style>
        .popup{
				position: relative;
				display: inline-block;
				cursor: pointer;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}

			/* The actual popup */
			.popup .popuptext {
				visibility: hidden;
				width: auto;
				min-width: 100px;
				background-color: #555;
				color: #fff;
				text-align: center;
				border-radius: 6px;
				padding: 8px 0;
				position: absolute;
				z-index: 1;
				right: 120%;
				top: -45px;
				margin-left: -80px;
			}

			
			tr td {
				padding: 8px;
			}

			

			/* Toggle this class - hide and show the popup */
			.popup .show {
				visibility: visible;
				/* -webkit-animation: fadeIn 1s;*/
				/*animation: fadeIn 1s; */
			}

			/* Add animation (fade in the popup) */
			@-webkit-keyframes fadeIn {
				/*from {opacity: 0; }*/
				/*to {opacity: 1; }*/
			}

			@keyframes fadeIn {
				/*from {opacity: 0; }*/
				/*to {opacity: 1; }*/
			}

            #buttonbar button {
                margin: -2px;
            }

    </style>
    
<head>
    <!-- Atualiza a pagina a cada 5 segundos -->
    <!-- <meta http-equiv="refresh" content="5;url=pedidoLista.php">  -->
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

            //Reload Page 
            function doRefresh(){
                $("#tabela-pedido").load("../../ajax/pedido-tabela.php");
            }

            //Carrega a lista apenas se a modal de impressão nao estiver aberta
            window.setInterval(function(){
                var verifica = $('body').hasClass('modal-open'); //Verifica se a modal está aberta
                if(verifica == false){ 
                    doRefresh();
                }
            }, 5000);
                
            //Responsável por mostrar os itens em cima do botão detalhes
            function myFunction(int) {
                var popup = document.getElementById('myPopup'+int);
                popup.classList.toggle('show');
            }

            //Funções que imprimem os itens mostrados na model
            function printDiv(elem){
                renderMe($('<div/>').append($(elem).clone()).html());
            }

            function renderMe(data) {
                // console.log(data);
                var mywindow = window.open('', 'invoice-box', 'height=750,width=750');
                mywindow.document.write('<html><head><title>Impressão Fiscal</title>');
                mywindow.document.write('<link rel="stylesheet" href="printstyle.css" type="text/css" style="height=750,width=750"/>');
                mywindow.document.write('</head><body >');
                mywindow.document.write(data);
                mywindow.document.write('</body></html>');


                setTimeout(function () {
                mywindow.print();
                mywindow.close();
                }, 1000)
                return true;
            }

            //Muda o status do pedido quando for impresso dentro da model
            function alteraStatusPrintModel(pedido,status){
                var url ='../../ajax/alterar-pedido.php?pedido='+pedido+'&status='+status;
                            $.get(url, function(dataReturn) {
                                if (dataReturn == 1) {
                                    msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoLista.php" );
                                }else{
                                    msgGenerico("Erro!",dataReturn,2,function(){});
                                }
                            });
                console.log("Botao clicado");
            }

            //Erro com a entrega do pedido
            function erroDelivery(pedido,status){
                if(status == 3) {
                    //hora Impressão
                    // var today = new Date();
                    // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    // console.log(time);
                    // horaImpressão(pedido);

                    msgRedireciona("Erro!","Esse pedido já saiu para a entrega!",1,"../../view/admin/pedidoLista.php" );
                }else{
                    //hora Impressão
                    // var today = new Date();
                    // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    // console.log(time);
                    
                    msgGenerico("Erro!","O pedido não foi impresso",2,function(){});
                }
            }

            //Muda o status do pedido para entregue ou retirado
            function alterarStatusDelivery(pedido,status){
                    //Segundo caso: Se o status do pedido for igual a 2
                    //Vai alterar ele apenas para ENTREGA
                    if(status-1 == 2){
                    msgConfirmacao('Confirmação','Deseja Realmente enviar o pedido para a entrega?',
                        function(linha){
                            var url ='../../ajax/alterar-pedido.php?pedido='+pedido+'&status='+status;
                            $.get(url, function(dataReturn) {
                                if (dataReturn == 1) {
                                    
                                    msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoLista.php" );
                                }else{
                                    msgGenerico("Erro!",dataReturn,2,function(){});
                                }
                            });  
                        },
                        function(){}
                    );
                }
            } 

            //Possível imprimir o pedido novamente
            function erroPrintModel(status,pedido){
                if(status == 2){
                    swal("Pedido já impresso!!!", "Deseja imprimir o pedido novamente?",
                    {
                        buttons:{
                            impressao: "Ver a impressão"
                        },
                    }).then((value) =>{
                        switch(value) {
                            case "impressao":
                                //Mudar a model
                                $('#modalPedido'+pedido).modal('show');
                                break;
                            default:
                                return 0;
                        }
                    })
                    // console.log("lala");
                }

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