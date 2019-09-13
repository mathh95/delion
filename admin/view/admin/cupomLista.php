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
</head>
<body>
    <header>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Área Administrativa <?= EMPRESA ?></h1>
                </div>
                <div class="col-md-2">
                    <div class="pull-right">
                        <h3>
                        <img src="../../img/person.png" alt="" />
                        <span>Bom dia <?php echo  $_SESSION['usuarioNome'] ?></span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse pull-left">
                            <ul class="nav navbar-nav">
                                <li class="dropdown ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="usuario.php">Cadastro</a></li>
                                        <li><a href="usuariosLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresa <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="empresa.php">Alterar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banners <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="banner.php">Cadastro</a></li>
                                        <li><a href="bannerLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avaliacao <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="tipoAvaliacao.php">Cadastro</a></li>

                                            <li><a href="tipoAvaliacaoLista.php">Listar</a></li>

                                            <li><a href="mediaAvaliacao.php">Médias</a></li>

                                        </ul>

                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Imagens <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="imagem.php">Cadastro</a></li>
                                        <li><a href="imagemLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Evento <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="evento.php">Cadastro</a></li>
                                        <li><a href="eventoLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categoria <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="categoria.php">Cadastro</a></li>
                                        <li><a href="categoriaLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cardápio <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cardapio.php">Cadastro</a></li>
                                        <li><a href="cardapioLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adicional <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="adicional.php">Cadastro</a></li>

                                            <li><a href="adicionalLista.php">Listar</a></li>
                                            
                                        </ul>

                                </li>   
                                <li class="dropdown ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mini banner <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="miniBanner.php">Cadastro</a></li>
                                        <li><a href="miniBannerLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cliente <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cliente.php">Cadastro</a></li>
                                        <li><a href="clienteLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="pedidoLista.php">Pedido</a>
                                </li>
                                <li class="dropdown">
                                    <a href="comboLista.php">Combo</a>
                                </li>
                                <li class="dropdown">
                                    <a href="/home/avaliacao.php">Avaliar</a>
                                </li>
                                <li class="dropdown">
                                    <a href="enderecoLista.php">Endereços</a>
                                </li>
                                <li class="dropdown">
                                    <!--/.Mudar aqui -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos Whatsapp <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="pedidoWpp.php">Novo Pedido</a></li>
                                        <li><a href="pedidoWppLista.php">Listar Pedidos</a></li>
                                        <li><a href="clienteListaWpp.php">Listar Clientes Whatsapp</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown active">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cupom<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cupom.php">Cadastro</a></li>
                                        <li><a href="cupomLista.php">Listar Cupons</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formas de Pagamento<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="formaPgt.php">Cadastro</a></li>
                                            <li><a href="formaPgtLista.php">Listar</a></li>
                                        </ul>
                                    </li> 
  
                            </ul>
                        </div><!--/.nav-collapse -->
                        <div class="pull-right">
                            <h2><a href="alteraSenha.php"> ALTERAR SENHA |</a>
                            <a href="../../controler/logout.php"> SAIR &nbsp;</a></h2>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
            <div class="row">
                <div class="col-lg-12" id="tabela-pedido">
                    <?php include "../../ajax/cupom-tabela.php"; ?>
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