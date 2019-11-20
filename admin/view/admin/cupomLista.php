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
</head>
<body>
    
    <?php include_once "./header.php" ?>

            <div class="row">
                <div class="col-lg-12" id="tabela-cupom">
                    <?php include "../../ajax/cupom-tabela.php"; ?>
                </div>
            </div>
        </div>

        <?php include VIEWPATH."/rodape.html" ?>
        <script src="../../js/alert.js"></script>
        <script type="text/javascript">

            function alterarStatusCupom(codigo,status){
                    if(status == 1){
                    msgConfirmacao('Confirmação','Deseja Realmente cancelar o cupom?',
                        function(linha){
                            var url ='../../ajax/alterar-cupom.php?codigo='+codigo+'&status='+status;
                            $.get(url, function(dataReturn) {
                                if (dataReturn == 1) {
                                    msgRedireciona("Sucesso!","Cupom cancelado com sucesso!",1,"../../view/admin/cupomLista.php" );
                                }else{
                                    msgGenerico("Erro!",dataReturn,2,function(){});
                                }
                            });  
                        },
                        function(){}
                    );
                }
            } 
          

            function erroCancel(status){
                if(status == 4) {
                    msgRedireciona("Erro!","O cupom já foi cancelado!",1,"../../view/admin/cupomLista.php" );
                }else{
                    msgGenerico("Erro!","O cupom não foi cancelado!",2,function(){});
                }
            }

        </script>
    </body>
    </html>