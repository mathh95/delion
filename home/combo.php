<?php 
session_start();
	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlCategoria.php";

	include_once "controler/controlImagem.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$controleCategoria=new controlerCategoria(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$categorias = $controleCategoria->selectAll();

	//configuração de acesso ao WhatsApp 
	include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/carrinho/xs/style-xs.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/carrinho/sm/style-sm.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/carrinho/md/style-md.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/carrinho/lg/style-lg.css" />

	<style>
		.swal-overlay {
            background-color: black;
        }
	</style>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>


	<div class="container itens">



	</div>

	<?php
		include_once "./rodape.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		$(document).ready(function () {

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

		$(document).ready(function () {

			$('.imagem-cardapio-evento').slick({

				slidesToShow: 1,

				slidesToScroll: 1,

				prevArrow: "<img class='a-left control-c prev slick-prev' src='img/seta-esquerda.png'>",

				nextArrow: "<img class='a-right control-c next slick-next' src='img/seta-direita.png'>"

			});

		});

		$(document).ready(function () {

			<?php 

    		$search = (isset($_GET['search'])) ? $_GET['search'] : NULL ;

    		$page = (isset($_GET['page'])) ? $_GET['page'] : 1 ;

    		?>

			$.ajax({

				type: 'GET',

				url: 'ajax/buscar-cardapio.php',

				data: {
					page: "<?= $page ?>",
					search: "<?= $search ?>",
					tipo: 'busca'
				},

				success: function (resultado) {

					$('.produtos').html(resultado);

				}

			});

		});


		$(document).ready(function () {

			$.ajax({
				type: 'GET',

				url: 'ajax/buscar-combo.php',

				success: function (resultado) {
					$(".itens").html(resultado);
				},
				error: function(err){
					console.log(err);
				}
			});
		});

	</script>

</body>

</html>