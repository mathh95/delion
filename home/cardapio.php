<?php 
	session_start();

	include_once "../config.php";

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlImagem.php";
	
	include_once "controler/controlCategoria.php";

	include_once "controler/controlAdicional.php";

	include_once MODELPATH."/adicional.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$controleCategoria=new controlerCategoria(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$categorias = $controleCategoria->selectAll();

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

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/cardapio/xs/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/cardapio/sm/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/cardapio/md/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/cardapio/lg/style-lg.css"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container menu">

		<div class="menu-lateral">

		<?php 

			foreach ($categorias as $categoria) {

				echo "<a href='#' id='".$categoria->getCod_categoria()."' onclick='buscar(1,\"".$categoria->getCod_categoria()."\",\"categoria\")'>

						<img src='../admin/".$categoria->getIcone()."'>

						<div>".strtoupper($categoria->getNome())."</div>

					</a>";

			}

		?>

		</div>

		<div class="imagem img hidden-xs">

			<?php 

				foreach ($imagens as $imagem) {

					$pagina = json_decode($imagem->getPagina());

					if (in_array('cardapio', $pagina)) {

						echo "<a  href='cardapio.php' ><img src='../admin/".$imagem->getFoto()."'></a>";

					}

				}

			?>

		</div>

	</div>

	<div class="container produtos">

		

		

	</div>

	<?php
		include_once "./rodape.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		$(document).on("click", "#addCombo", function() {
			var cod = $(this).data('cod');
			var largura = $(window).width();
			if(largura <= 767){
				$('#myModalC'+cod).modal('show');
			}else{
				$('#myModal'+cod).modal('show');
			}
			
		});

    	$(document).ready(function(){

			$('.imagem').slick({

			slidesToShow: 1,

			slidesToScroll: 1,

			prevArrow:"<img class='a-left control-c prev slick-prev' src='img/seta-esquerda.png'>",

				nextArrow:"<img class='a-right control-c next slick-next' src='img/seta-direita.png'>"

			});

		});

    	$(document).ready(function(){

    		<?php 

    		$search = (isset($_GET['search'])) ? $_GET['search'] : NULL ;

    		$page = (isset($_GET['page'])) ? $_GET['page'] : 1 ;

    		?>

			$.ajax({

				type:'GET',

				url: 'ajax/buscar-cardapio.php',

				data: {page: "<?= $page ?>", search: "<?= $search ?>", tipo: 'busca'},

				success:function(resultado){

					$('.produtos').html(resultado);

				}

			});

		});

		
		$(document).on("click", "#addCarrinho", function(){
			var url = $(this).data('url');
			var qtd = $('#spanCarrinho').text();
			// alert(qtd);
			var id = $(this).data('cod');
			// var quantidade = $("#spanCarrinho").data('quantidade');
						
			// console.log(quantidade+1);

			$.ajax({
				
				type: 'GET',

				url: url,

				data: {id: id},

				success:function(res){
					$("#spanCarrinho").html(res);
					if(qtd == res){
						swal('Este item já está no seu carrinho!', 'Para alterar a quantidade, vá ao seu carrinho.', 'warning');
					}else{
					// $("body,html").animate({scrollTop: 0 }, 800);
					swal("Produto Adicionado ao carrinho!!", "Você pode consultar o carrinho para modificar a quantidade.", "success");
					}
				}, 
				error: function(erro){
					console.log(erro);
				}
			});
		});

		function buscar (pagina, busca, tipo){

			$.ajax({

				type:'GET',

				url: 'ajax/buscar-cardapio.php',

				data: {page: pagina , search: busca, tipo: tipo },

				success:function(resultado){

					$('.produtos').html(resultado);

				}

			});

		}

		function adicionaCombo(item){

			adicionais = new Array();
			var largura = $(window).width();
			$("input[type=checkbox][name='adicional']:checked").each(function(){
    			adicionais.push($(this).val());
			});

			$.ajax({
				type:'POST',

				url:'ajax/add-combo.php',

				data:{item:item, adicionais:adicionais},

				success:function(res){
					$("#spanCombo").html(res);
					if(largura <= 767){
						$("#myModalC"+item).modal('hide');
					}else{
						$("#myModal"+item).modal('hide');
					}
					
				}
			});
		}

		function fecharModal(idCardapio){
			var largura = $(window).width();
			if(largura <= 767){
				$("#myModalC"+idCardapio).modal('hide');
			}else{
				$("#myModal"+idCardapio).modal('hide');
			}
		}
	</script>

</body>

</html>