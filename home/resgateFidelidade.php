<?php 
	
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	session_start();

	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";
	include_once "controler/controlImagem.php";

	//configuração de acesso ao WhatsApp
	//include "./whats-config.php";

	//Verifica se usuário já habilidato para o Programa
	if(!isset($_SESSION['data_nasc']) ||  $_SESSION['data_nasc'] == "") header("Location: /home/cadastroFidelidade.php");
	//var_dump($_SESSION);
?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/fidelidade/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/fidelidade/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/fidelidade/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/fidelidade/style-lg.css"/>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>
	
	<div class="container-fluid main">
		<div class="container">
			<div class="resgate-main">
				<h2>Programa de Fidelidade</h2>
				<div class="pontos-info">
					<p>
						Produtos que você pode resgatar
					</p>

					<div class="pontos-wrapper">
						<p>Você possui: <span>1044 pontos</span></p>
						<p>Pontuação mínima: <span>30 pontos</span></p>
					</div>

				</div>

				<div class="tabela-produtos">
					<div class="produtos-titulo">
						Produtos para resgate
					</div>

					<div class="btn-wrapper-resgate">

					</div>
				</div>
			</div>

		</div>
	</div>

	

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

	
	</script>

</body>

</html>