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
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/cliente/xs/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/cliente/sm/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/cliente/md/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/cliente/lg/style-lg.css"/>
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
					
                <input name="cod_cliente" type="hidden" value="<?php echo $_SESSION['cod_cliente'];?>">
				
				<div>

					<p>Senha antiga:</p>

        			<input name="senha" type="password" minlength="4" maxlength="40" required placeholder="******">

    			</div>
                <div>

					<p>Nova senha:</p>

                    <input name="novaSenha" type="password" required minlength="4" maxlength="40" placeholder="******">

                </div>
    			<div>

					<p>Confirmar nova senha:</p>

        			<input name="confirma" type="password" required minlength="4" maxlength="40" placeholder="******">

    			</div>

    			<button type="submit">ALTERAR</button>
                

			</form>

		</div>

		<div class="imagem">

			<?php

			$i = 0; 

			foreach ($imagens as $imagem) {

				$pagina = json_decode($imagem->getPagina());

				if (in_array('contato', $pagina) && ($i < 2)) {

					echo "<div><img src='../admin/".$imagem->getFoto()."'></div>";

					$i++;

				}

			}

			?>

		</div>

	</div>

	<div class="container imagens">

	<?php

	$j = 0;

	foreach ($miniBanners as $miniBanner) {

		$pagina = json_decode($miniBanner->getPagina());

		if (in_array('contato', $pagina) && ($j < 3) ) {

		echo"

		<div>

			<div class='imagem'>

				<img src='../admin/".$miniBanner->getFoto()."'>

			</div>

		</div>

		";

		$j++;

		}

	}

	?>

	</div>

	<div class="container banner hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

	<?php 

		foreach ($banners as $banner) {

			$pagina = json_decode($miniBanner->getPagina());

			if (in_array('contato', $pagina)) {

				echo "<img src='../admin/".$banner->getFoto()."'>";

				break;

			}

		}

	?>

	</div>

	<?php
		include_once "./rodape.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

</body>

</html>