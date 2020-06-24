<?php

	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

    include_once "controler/controlImagem.php";
    
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	include_once MODELPATH."/cliente.php";
	
	include_once "controler/segurancaCliente.php";

	include_once "./configuracaoCores.php";

	protegeCliente();

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleImagem=new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";
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

						<input class="form-control" name="nome" type="text" minlength="3" maxlength="30" required value="<?php echo $_SESSION['nome'];?>"autofocus style="border: 2px solid <?=$corSec?>;">

					</div>
					
					<div class="col-md-6 col-sm-12 col-xs-12">
						
						<p>Sobrenome:</p>

						<input class="form-control" name="sobrenome" type="text" minlength="3" maxlength="30" required value="<?php echo $_SESSION['sobrenome'];?>" style="border: 2px solid <?=$corSec?>;">

					</div>
				</div>
				
    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Login (e-mail):</p>

        			<input name="login" class="form-control" type="text" minlength="4" maxlength="40" required placeholder="Login" value="<?php echo $_SESSION['login'];?>" style="border: 2px solid <?=$corSec?>;">

				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Celular:</p>

					<input class="form-control telefone" name="telefone" type="text" minlength="8" maxlength="16" required placeholder="(45) 9 9999-9999" value="<?php echo $_SESSION['telefone'];?>" style="border: 2px solid <?=$corSec?>;">

				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">

    				<button class="btn-alterar-cadastro" type="submit" style="background-color: <?= $corSec?>;">ALTERAR</button>
				</div>

			</form>

		</div>

		
	</div>

	

	

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>


	<script>

	$(document).ready(function(){
		$(".telefone").mask("(45) 99999-9999");
	});

	</script>

</body>

</html>