<?php

	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

    include_once "controler/controlImagem.php";
    
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	include_once MODELPATH."/cliente.php";
	
	include_once "controler/segurancaCliente.php";

	protegeCliente();

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleBanner=new controlerBanner(conecta());

	$miniBanners = $controleBanner->selectAllMini();

	$banners = $controleBanner->selectAll();

	$controleImagem=new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/cliente/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/cliente/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/cliente/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/cliente/style-lg.css"/>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container cliente">

		<div class="solicitacao">
			<form action="controler/alterarCliente.php" method="POST">

				<p>Alterar dados da sua conta</p>

                    <input name="cod_cliente" type="hidden" value="<?php echo $_SESSION['cod_cliente'];?>">
				
				<div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						
						<p>Nome:</p>

						<input class="form-control" name="nome" type="text" minlength="3" maxlength="30" required value="<?php echo $_SESSION['nome'];?>"autofocus>

					</div>
					
					<div class="col-md-6 col-sm-12 col-xs-12">
						
						<p>Sobrenome:</p>

						<input class="form-control" name="sobrenome" type="text" minlength="3" maxlength="30" required value="<?php echo $_SESSION['sobrenome'];?>">

					</div>
				</div>
				
    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Login (e-mail):</p>

        			<input name="login" class="form-control" type="text" minlength="4" maxlength="40" required placeholder="Login" value="<?php echo $_SESSION['login'];?>">

				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Celular:</p>

					<input class="telefone" name="telefone" type="text" minlength="8" maxlength="16" required placeholder="(45) 9 9999-9999" value="<?php echo $_SESSION['telefone'];?>">

				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">

    				<button class="btn-alterar-cadastro" type="submit">ALTERAR</button>
				</div>

			</form>

		</div>

		
	</div>

	

	

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		$(document).ready(function(){
		

			$("input.telefone").mask("(99) 9999-9999?9").focusout(function (event) {  

				var target, phone, element;  

				target = (event.currentTarget) ? event.currentTarget : event.srcElement;  

				phone = target.value.replace(/\D/g, '');

				element = $(target);  

				element.unmask();  

				if(phone.length > 10) {  

					element.mask("(99) 99999-999?9");  

				} else {  

					element.mask("(99) 9999-9999?9");  

				}  

			});
		});

	</script>

</body>

</html>