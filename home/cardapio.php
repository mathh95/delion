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

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/cardapio/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/cardapio/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/cardapio/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/cardapio/style-lg.css"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container-fluid menu">

		<div class="menu-lateral">

		<?php 
			$categorias = $controleCategoria->selectAllByPos();

			foreach ($categorias as $key => $categoria) {
				
				if($key == 0){
					echo "<a class= 'item-categoria active' href='#categoria".$categoria->getCod_categoria()."' id='".$categoria->getCod_categoria()."'>
							<img src='../admin/".$categoria->getIcone()."'>
						<div>".strtoupper($categoria->getNome())."</div>

					</a>";
				}else{
					echo "<a class= 'item-categoria' href='#categoria".$categoria->getCod_categoria()."' id='".$categoria->getCod_categoria()."'>
							<img src='../admin/".$categoria->getIcone()."'>
						<div>".strtoupper($categoria->getNome())."</div>

					</a>";
				}

			}

		?>

		</div>

		

	</div>

	<div class="container produtos">

		

		

	</div>
		
	<div class="scroll-top">

		<a href="#top">

			<i class="far fa-caret-square-up"></i>

		</a>

	</div>
		<div class="barra-carrinho" id="barra-carrinho">
			<div>
			<a  data-toggle="tooltip" title="Carrinho." href="carrinho.php">
				<i style=" font-size: 17px;"class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
				</i> 
				<span style="background-color:white; color:black;" class="badge" id="spanCarrinho-barra">
				<?php echo (isset($_SESSION['carrinho']))?count($_SESSION['carrinho']):'0';?>
				</span>
			</a>
		</div>
		<div class="texto-barra">

			<a href="carrinho.php">Ver Carrinho</a>
		</div>

		
	</div> 
	
	
	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		// Selecionar Categoria
		$('.item-categoria').on('click', function(){
			
			var $this = $(this);
			var cod_categoria = $this.data('id');

			// cor
			$('.active').removeClass('active');
			$this.toggleClass('active');

		});


		// var categorias = $('.categoria')
		// , menu_lateral = $('.menu-lateral')
		// , menu_lateral_height = menu_lateral.outerHeight();

		// $(window).on('scroll', function () {
		// 	var cur_pos = $(this).scrollTop();
			
		// 	categorias.each(function() {
		// 		var top = $(this).offset().top - menu_lateral_height,
		// 		bottom = top + $(this).outerHeight();
				
		// 		if (cur_pos >= top && cur_pos <= bottom) {

		// 			menu_lateral.find('a').removeClass('active');
		// 			// categorias.removeClass('active');
		// 			$(this).addClass('active');
		// 			console.log($(this).attr('id'));
		// 			menu_lateral.find('a[href="#categoria'+$(this).attr('id')+'"]').addClass('active');
		// 			// console.log('a[href="#'+$('categoria'+this).attr('id')+'"]');
		// 		}
		// 	});
		// });

		// Scroll p/ Categoria selecionada
		$(document).ready(function() {
			$('a[href^="#"]').click(function() {
				var target = $(this.hash);
				if (target.length == 0) target = $('a[name="' + this.hash.substr(1) + '"]');
				if (target.length == 0) target = $('html');
				$('html, body').animate({ scrollTop: target.offset().top-100 }, 600);
				return false;
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
		var qtd_carrinho = "<?= isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : ''?>";
		function displayBarraCarrinho(){
			
				if(qtd_carrinho == '' || qtd_carrinho == 0){
					$("#barra-carrinho").hide();
				}else{
					$("#barra-carrinho").fadeIn(1000);
				}
		}
		$(document).ready(function() {
			displayBarraCarrinho();
			
		});

		$(document).on("click", "#addCarrinho", function(){
			var url = $(this).data('url');
			var qtd = $('#spanCarrinho').text();
			var id = $(this).data('cod');
			
			const nomeItem = $('#tituloNome'+id).text();
			swal({
				title: "Alguma Observação?",
				text: `Para: ${nomeItem}`,
				content: "input",
				icon: "warning"
			})
			.then((observacaoItem) => {
				$.ajax({type: 'GET', url: url, data: {observacaoItem: observacaoItem, id: id},
					success:function(resObs){
						$("#spanCarrinho").html(resObs);
						$("#spanCarrinho-navbar").html(resObs);
						$("#spanCarrinho-barra").html(resObs);
						
						if(qtd == resObs){
							swal('Este item já está no seu carrinho!', 'Consulte o carrinho', 'warning');
						}else{
							swal('Produto Adicionado ao carrinho!', 'Consulte o carrinho para alterar a quantidade', 'success');
							//Exibe caso tenha mais de 0 itens no carrinho.
							qtd_carrinho++; 
							displayBarraCarrinho();
							
						}
						
					}
				});
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