<?php 
session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlEvento.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleEvento=new controlerEvento(conecta());

	$antigoEventos = $controleEvento->selectAllAntigo();

	$novoEventos = $controleEvento->selectAllNovo();

	setlocale (LC_TIME, 'ptb');

	//configuração de acesso ao WhatsApp 
	include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/eventos/xs/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/eventos/sm/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/eventos/md/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/eventos/lg/style-lg.css"/>

</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container solicitar-evento">

		<div class="solicitacao hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

			<div>

				<h2>Solicitação de Evento</h2>

			</div>

			<div>

				<form method="POST" action="ajax/enviaEmail.php" class="form-horizontal form-contato">

					<div>

						<div>

							<input name="nome" type="text" required placeholder="Nome">

						</div>

						<div>

							<input name="telefone" type="text" required placeholder="Fone" class="telefone">

						</div>

					</div>

					<div>

						<div>

							<div>

								<input type="email" required name="email" placeholder="E-mail">

							</div>

							<div>

								<input type="date" min="<?= date('Y-m-d');?>" name="data" class="calendario" value="<?= date('Y-m-d');?>">

							</div>

						</div>

						<div>

							<div>

								<div>Início</div>

								<input type="text" class="timepicker-inicio" name="horaInicio"/>

							</div>

							<div>

								<div>Término</div>

								<input type="text" class="timepicker-termino" name="horaFim"/>

							</div>

						</div>

					</div>

					<div>

						<div>

							<textarea rows="3" name="descricao" placeholder="Descrição" maxlength="300"></textarea>

						</div>

						<div>

							<div>

								<div>Convidados</div>

								<input name="convidados" type="number" required value="0" min="0" max="999">

							</div>

							<img src="img/evento_logo.png" alt="" class="hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">

							<button>ENVIAR</button>

						</div>

					</div>

					<input type="hidden" value="Solicitação de evento" name="assunto">

				</form>

			</div>

		</div>

		<div class="imagem">

			<?php 

			foreach ($novoEventos as $novoEvento) {

				echo "<img src='../admin/".$novoEvento->getFoto()."'>";

			}

			?>

		</div>

	</div>

	<div class="container eventos">

	<?php foreach ($antigoEventos as $antigoEvento) { ?>

		<div class="evento">

			<div class="imagem">

				<img src="<?= "../admin/".$antigoEvento->getFoto(); ?>" alt="">

			</div>

			<img src="img/logo_evento_300.fw.png" alt="">

			<div class="info">

				<div class="data"><?= ucfirst(strftime('%b/%Y',strtotime($antigoEvento->getData()))); ?></div>

				<div class="titulo"><?= mb_convert_case($antigoEvento->getNome(), MB_CASE_UPPER, 'UTF-8');?></div>

			</div>

		</div>

	<?php } ?>	

	</div>

	<?php
		include_once "./rodape.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		$(document).ready(function(){

      		$('.banner-superior').slick({

        		slidesToShow: 1,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 3000,

				arrows: false,

			 	speed: 800,

				fade: true,

				dots: true

      		});

    	});

    	$(document).ready(function(){

      		$('.imagem-cardapio-evento').slick({

        		slidesToShow: 1,

				slidesToScroll: 1,

				prevArrow:"<img class='a-left control-c prev slick-prev' src='img/seta-esquerda.png'>",

      			nextArrow:"<img class='a-right control-c next slick-next' src='img/seta-direita.png'>"

      		});

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