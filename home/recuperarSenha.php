<?php 
	session_start();

	if(isset($_SESSION['cod_cliente'])){
		header("Location: /home");
	}

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

	include_once "controler/controlImagem.php";

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
	
	<div class="container-fluid cliente-recuperar row">

		<div class="solicitacao">

			<form action="controler/recuperarAcesso.php" method="POST">
			
				<p>Recuperação de Senha</p>

    			<div>

					<p>Login (e-mail)</p>

        			<input class="form-control" name="login" type="email" required placeholder="delion@mail.com">

    			</div>

				<div class="botoes-recuperar">
					<button type="submit">Recuperar Senha</button>

					<button style="float: right;" onclick="window.history.go(-1)" >Voltar</button>					
				</div>
			</form>
			
			
		</div>		

		

	</div>

	</div>

	<!-- <div class="login_google container-fluid row">

		<h1>Você pode logar pelo Google se preferir!</h1>

		

	</div> -->

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>
		
	</script>

</body>

</html>