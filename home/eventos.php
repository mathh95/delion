<?php 
session_start();

	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";
	include_once "controler/controlEvento.php";

	$controleEmpresa = new controlerEmpresa(conecta());
	$empresa = $controleEmpresa->select(1,2);

	$controleEvento = new controlerEvento(conecta());
	$antigoEventos = $controleEvento->selectAllAntigo();
	$novoEventos = $controleEvento->selectAllNovo();

	setlocale (LC_TIME, 'ptb');

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/eventos/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/eventos/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/eventos/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/eventos/style-lg.css"/>

</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container solicitar-evento">

		<div class="row solicitacao visible-xs-* visible-sm-* visible-md-* visible-lg-* visible-xl-* form-group">

			<div class="titulo-eventos">
				<h2><i class="fas fa-bookmark"></i> Solicitação de orçamento </h2>
			</div>

			<div class="col-sm campos-evento">

				<form method="POST" action="ajax/enviaEmail.php" class="form-horizontal form-contato">

						

						<input name="telefone" type="text" required placeholder="Fone/Whatsapp" class="telefone form-control">

						<input type="email" required name="email" placeholder="E-mail" class="form-control">

						
						<textarea rows="3" class="form-control" name="descricao" placeholder="Descrição" maxlength="300"></textarea>



						<button class="form-control">ENVIAR</button>
						<input type="hidden" value="[Evento] - Solicitação de Evento" name="assunto">
				</form>
				
			</div>
			<div class="col-sm texto-eventos">
				<h5>Salão Climatizado para 80 pessoas</h5>
				<ul>
					<li>Reuniões Familiares.</li>
					<li>Confraternizações.</li>
					<li>Aniversários.</li>
					<li>Coquetéis.</li>
					<li>Palestras.</li>
					<li>Vernissages.</li>
				</ul>
				<p>Preencha o formulário ao lado para solicitar seu orçamento.</p>
			</div>
			<div class="col-sm slider main-carousel">
				<img src="img/Evento_img2.jpg" alt="torta" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img3.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img4.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img5.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img6.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img7.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img8.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img9.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img10.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img11.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
				<img src="img/Evento_img12.jpg" alt="imagem evento 2" class=" carousel-cell hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">
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
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

	<script src="https://unpkg.com/flickity-fade@1/flickity-fade.js"></script>

	<script>


		//flickity.js para slider da imagem da pagina de eventos
		$('.main-carousel').flickity({
				fade: true,
				autoPlay: 3000,
				cellAlign: 'left',
				contain: true,
				prevNextButtons: false,
				pageDots: false
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

    	$("input.telefone").mask("(99) ?9 9999-9999").focusout(function (event) {  

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