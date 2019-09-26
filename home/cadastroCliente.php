<?php 
	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

	include_once "controler/controlImagem.php";

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

			<form id="cadastro-form">
				
				<p>Cadastro de cliente</p>

    			<div>
					
					<p>Nome:</p>

        			<input class="form-control" name="nome" type="text" minlength="4" maxlength="30" required placeholder="Delion de Oliveira">

    			</div>
    			<div>

					<p>Login:</p>

        			<input class="form-control" name="login" type="email" minlength="4" maxlength="40" required placeholder="delion@mail.com">

    			</div>

				<div>

					<p>Senha:</p>

					<input class="form-control" name="senha" type="password" minlength="4" maxlength="40" required placeholder="******">

				</div>

				<div>

					<p>Confirmar Senha:</p>

					<input class="form-control" name="senha2" type="password" minlength="4" maxlength="40" required placeholder="******">

				</div>

				<div>

					<p>Telefone:</p>

					<input class="form-control" name="telefone" type="text" minlength="8" maxlength="16" required placeholder="(45) 9 9999-9999">

				</div>
				
    			<button type="submit" id="cadastrar">CADASTRAR</button>
								
			</form>

		</div>

		<div class="imagem-login">

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
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		//Cadastro Cliente
		$("#cadastrar").on("click", function(){

			var data = $('#cadastro-form').serializeArray();
			
			//verifica se campos estão preenchidos
			if(data[0].value == ""){
				return;
			}else if(data[1].value == ""){
				return;
			}else if(data[2].value == ""){
				return;
			}else if(data[3].value == ""){
				return;
			}else if(data[4].value == ""){
				return;
			}else{
				$.post({
					url: 'controler/businesCliente.php',
					data: data,
					success: function(resultado){
						//console.log("#"+resultado+"#");
						if(resultado.includes("inserido")){
							//redireciona para boas vindas
							window.location = "/home?bem_vindo=true";
						}else{
							swal("Erro :/", resultado , "error");
						}
					},
					error: function(resultado){
						swal("Erro :/", "Entre em contato com o suporte." , "error");
					}
				});
			}
		});

    	$('.timepicker-inicio').wickedpicker({

    		twentyFour: true

    	});

    	$('.timepicker-termino').wickedpicker({

    		twentyFour: true

    	});

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

	</script>

</body>

</html>