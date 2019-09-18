<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    </style>
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>

    <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
</head>
<body>
    
    <?php include_once "./header.php" ?>

            <div class="">
                <div class="col-lg-12" id="tabela-pedido">
                    <?php include "../../ajax/pedidoWpp-tabela.php"; ?>
                </div>
            </div>
        </div>

        <?php include VIEWPATH."/rodape.html" ?>
        <script src="../../js/alert.js"></script>
        <script type="text/javascript">
                //Primeiro caso: Se o status do pedido for igual a 1
                //Vai alterar ele apenas para IMPRESSO
                function alterarStatusPrint(pedido,status){
                    if(status-1 == 1){
                    msgConfirmacao('Confirmação','Deseja Realmente imprimir o comprovante de venda?',
                        function(linha){
                            // console.log("Antes do get",status);
                            var url ='../../ajax/alterar-pedidoWpp.php?pedido='+pedido+'&status='+status;
                            $.get(url, function(dataReturn) {
                                if (dataReturn == 1) {
                                    msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoWppLista.php" );
                                    // gerarPrint(status);
                                }else{
                                    msgGenerico("Erro!",dataReturn,2,function(){});
                                }
                            });  
                        },
                        function(){}
                    );
                }
            }

            function alterarStatusPrint(pedido,status){
                    if(status-1 == 1){
                    msgConfirmacao('Confirmação','Deseja Realmente imprimir o comprovante de venda?',
                        function(linha){
                            // console.log("Antes do get",status);
                            var url ='../../ajax/alterar-pedidoWpp.php?pedido='+pedido+'&status='+status;
                            $.get(url, function(dataReturn) {
                                if (dataReturn == 1) {
                                    msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoWppLista.php" );
                                    // gerarPrint(status);
                                }else{
                                    msgGenerico("Erro!",dataReturn,2,function(){});
                                }
                            });  
                        },
                        function(){}
                    );
                }
            }
            
            function myFunction(int) {
                var popup = document.getElementById('myPopup'+int);
                popup.classList.toggle('show');
            }

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

            // Função que imprime uma div
            // function printDiv2(divID){
            //     var restorepage = document.body.innerHTML;
            //     var printcontent = document.getElementById(divID).innerHTML;
            //     document.body.innerHTML = printcontent;
            //     window.print();
            //     document.body.innerHTML = restorepage;
            // }

            // function printElem() {
            //     var content = document.getElementById('modalPedido').innerHTML;
            //     var mywindow = window.open('', 'Print', 'height=600,width=800');

            //     mywindow.document.write('<html><head><title>Print</title>');
            //     mywindow.document.write('</head><body >');
            //     mywindow.document.write(content);
            //     mywindow.document.write('</body></html>');

            //     mywindow.document.close();
            //     mywindow.focus()
            //     mywindow.print();
            //     mywindow.close();
            //     return true;
            // }

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

            function alterarStatusDelivery(pedido,status){
                    //Segundo caso: Se o status do pedido for igual a 2
                    //Vai alterar ele apenas para ENTREGA
                    if(status-1 == 2){
                    msgConfirmacao('Confirmação','Deseja Realmente enviar o pedido para a entrega?',
                        function(linha){
                            var url ='../../ajax/alterar-pedidoWpp.php?pedido='+pedido+'&status='+status;
                            $.get(url, function(dataReturn) {
                                if (dataReturn == 1) {
                                    
                                    msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoWppLista.php" );
                                }else{
                                    msgGenerico("Erro!",dataReturn,2,function(){});
                                }
                            });  
                        },
                        function(){}
                    );
                }
            } 
          
			
            //Função ativada quando a ação não é permitida
            function erroDelivery(pedido,status){
                if(status == 3) {
                    //hora Impressão
                    // var today = new Date();
                    // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    // console.log(time);
                    horaImpressão(pedido);

                    msgRedireciona("Erro!","Esse pedido já saiu para a entrega!",1,"../../view/admin/pedidoWppLista.php" );
                }else{
                    //hora Impressão
                    // var today = new Date();
                    // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    // console.log(time);
                    
                    msgGenerico("Erro!","O pedido não foi impresso",2,function(){});
                }
            }
            
            function horaImpressão(pedido){
                var today = new Date();
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                console.log(time);

                insereHoraPedido(time);

            }


            function erroPrint(status){
                if(status == 2) {
                    msgRedireciona("Erro!","A nota fiscal desse pedido já foi impressa!",1,"../../view/admin/pedidoWppLista.php" );
                }else{
                    msgGenerico("Erro!","O pedido não foi impresso",2,function(){});
                }
            }

            function alteraStatusPrintModel(pedido,status){
                var url ='../../ajax/alterar-pedidoWpp.php?pedido='+pedido+'&status='+status;
                            $.get(url, function(dataReturn) {
                                if (dataReturn == 1) {
                                    msgRedireciona("Sucesso!","Status de pedido alterado!",1,"../../view/admin/pedidoWppLista.php" );
                                }else{
                                    msgGenerico("Erro!",dataReturn,2,function(){});
                                }
                            });
                console.log("Botao clicado");
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
                var url = '../../ajax/pedidoWpp-tabela.php';
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