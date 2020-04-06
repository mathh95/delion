<?php 
	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

    include_once "controler/controlImagem.php";
    
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	include_once MODELPATH."/cliente.php";
	
	include_once "controler/segurancaCliente.php";

	include_once CONTROLLERPATH."/controlerGerenciaSite.php";

	include_once MODELPATH."/gerencia_site.php";

	protegeCliente();

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleImagem=new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";

	//Esquema de cores do gerenciar site
	$controle=new controlerGerenciarSite($_SG['link']);
	$config = $controle->selectConfigValida();
	$corSec = $config->getCorSecundaria();

		if(empty($corSec)){
			$corSec = "#C6151F";
			$corPrim = "#D22730";
		}else{
			$corSec = $config->getCorSecundaria();
			$corPrim = $config->getCorPrimaria();
		}
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
			<form action="controler/alterarSenha.php" method="POST">
				
				<p>Alterar senha</p>
					
                <input name="cod_cliente" type="hidden" value="<?php echo $_SESSION['cod_cliente'];?>" style="border: 2px solid <?=$corSec?>;">
				
				<div>

					<p>Senha antiga:</p>

        			<input name="senha" type="password" minlength="4" maxlength="40" required placeholder="******" style="border: 2px solid <?=$corSec?>;">

    			</div>
                <div>

					<p>Nova senha:</p>

                    <input name="novaSenha" type="password" required minlength="4" maxlength="40" placeholder="******" style="border: 2px solid <?=$corSec?>;">

                </div>
    			<div>

					<p>Confirmar nova senha:</p>

        			<input name="confirma" type="password" required minlength="4" maxlength="40" placeholder="******" style="border: 2px solid <?=$corSec?>;">

    			</div>

				<div>

    				<button type="submit" style="background-color: <?= $corSec?>;">ALTERAR</button>
				
				</div>

			</form>

		</div>

		

	</div>

	

	

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

</body>

</html>