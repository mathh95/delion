<?php 
	session_start();

	include_once "../config.php";

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlImagem.php";
	
	include_once "controler/controlCategoria.php";

	include_once "controler/controlAdicional.php";

	include_once MODELPATH."/adicional.php";

	$controleEmpresa = new controlerEmpresa(conecta());

	$controleCategoria = new controlerCategoria(conecta());

	$empresa = $controleEmpresa->select(1,2);


	$controleImagem = new controlerImagem(conecta());

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

<nav class="navbar" id="navbar-cardapio">
	
	<div class="container-fluid menu">

		<div class="menu-lateral">
        	<ul class="nav nav-pills">
			
		<?php 
			$categorias = $controleCategoria->selectAllByPos();

			foreach ($categorias as $key => $categoria) {
				
				if($key == 0){	
					echo "
						<li class='nav-item active'><a class= 'nav-link item-categoria' href='#categoria".$categoria->getPkId()."' id='".$categoria->getPkId()."'>
							<div>".$categoria->getNome()."</div>
						</a></li>";
				}else{
					echo "
						<li class='nav-item '><a class= 'nav-link item-categoria' href='#categoria".$categoria->getPkId()."' id='".$categoria->getPkId()."'>
							<div>".$categoria->getNome()."</div>
						</a></li>";
				}

			}

		?>
		</ul>
      </div>

		</div>
</nav>

	<div class="container produtos" id="container-produtos" data-spy="scroll" data-target=".menu-lateral" data-offset-top="-200">
		

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

		$(document).ready(function(){
    		doRefresh();
		});

		function doRefresh(){
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
				success:function(resultado){
					$('#container-produtos').html(resultado);
				}
			});
		}

		//Auto Reload cardapio
		window.setInterval(function(){
			doRefresh();
        }, 60000);//1 minuto


		//Scrollspy para deixar active a categoria atual.
		$('body').scrollspy({ target: '#navbar-cardapio' });
		$('[data-spy="scroll"]').each(function () {
			var $spy = $(this).scrollspy('refresh')
		});

		// Scroll p/ Categoria selecionada
		$(document).ready(function() {
			$('a[href^="#"]').click(function() {
				var target = $(this.hash);
				if (target.length == 0) target = $('a[name="' + this.hash.substr(1) + '"]');
				if (target.length == 0) target = $('html');
				$('html, body').animate({ scrollTop: target.offset().top }, 600);
				
				return false;
			});
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


		// $(document).ready(function(){
		// 	$(".menu").animate({scrollCenter: "li.active"}, 400);
		// });

		// $(window).on('load', function() {
		// 	$(".menu").scrollCenter("li.active", 400);
		// });
		

		// setTimeout( function(){
			 
		// 	window.scrollTo( screen.width/2, screen.height/2 );
  		// }  , 500 );

		// $(window).scroll(function (event) {
    	// 	var scroll = $(window).scrollTop();
		// 	$(".menu").scrollCenter("li.active", 400);
		// });
		// $(".a").on('click', function(){
		// 	$(".menu").scrollCenter("li.active", 400);
		// });

		// $(document).ready(function() { 
		// 	$(window).load(function() { 
		// 		$(".menu").scrollCenter("li.active", 400);
		// 	});
		// });

		// window.addEventListener("DOMContentLoaded", function(){
		// 	$(".menu").scrollCenter("li.active", 400);
		// });
					
					

		// jQuery.fn.scrollCenter = function(elem, speed) {

		// 	var active = jQuery(this).find(elem); // find the active element
		// 	var activeWidth = active.width() / 2; // get active width center

		// 	var pos = active.position().left + activeWidth; //get left position of active li + center position
		// 	var elpos = jQuery(this).scrollLeft(); // get current scroll position
		// 	var elW = jQuery(this).width(); //get div width
		// 	pos = pos + elpos - elW / 2; // for center position if you want adjust then change this

		// jQuery(this).animate({
		// 	scrollLeft: pos
		// }, speed == undefined ? 1000 : speed);
		// return this;
		// };

		// jQuery.fn.scrollCenterORI = function(elem, speed) {
		// jQuery(this).animate({
		// 	scrollLeft: jQuery(this).scrollLeft() - jQuery(this).offset().left + jQuery(elem).offset().left
		// }, speed == undefined ? 1000 : speed);
		// return this;
		// };



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

			var qtd = $('#spanCarrinho').text();
			var id = $(this).data('cod');
			
			const nomeItem = $('#tituloNome'+id).text();

			swal({
				title: "Alguma Observação?",
				text: `${nomeItem}`,
				content: "input",
				icon: "info",
				button: 'Prosseguir'
			})
			.then((observacaoItem) => {
				$.ajax({
					type: 'GET',
					url: 'ajax/add-carrinho.php',
					data: {observacaoItem: observacaoItem, id: id},
					success:function(resObs){
						$("#spanCarrinho").html(resObs);
						$("#spanCarrinho-navbar").html(resObs);
						$("#spanCarrinho-barra").html(resObs);
						
						if(qtd == resObs){
							swal({
								title: "Item já Adicionado! 😋",
								text: "Consulte o carrinho...",
								icon: "warning",
								timer: 1100,
								buttons: false
							});
						}else{
							swal({
								title: "Item Adicionado! 😋",
								text: "Consulte o carrinho...",
								icon: "success",
								timer: 1000,
								buttons: false
							});
							//Exibe caso tenha mais de 0 itens no carrinho.
							qtd_carrinho++; 
							displayBarraCarrinho();
						}
					}
				});
			});

			$(".swal-content__input").attr("placeholder", "Exemplo: Sem queijo...");
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