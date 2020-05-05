<?php 
	session_start();

	include_once "../config.php";

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlImagem.php";
	
	include_once "controler/controlCategoria.php";

	include_once "controler/controlAdicional.php";

	include_once MODELPATH."/adicional.php";

	include_once "./configuracaoCores.php";

	$controleEmpresa = new controlerEmpresa(conecta());

	$controleCategoria = new controlerCategoria(conecta());

	$empresa = $controleEmpresa->select(1,2);


	$controleImagem = new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();
	
    $controleAdicional = new controlerAdicional(conecta());
	$adicionais = $controleAdicional->selectAllF();
	

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Delion Café - Delivery Foz do Iguaçu | Cardápio</title>
	<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="description" content="Espaço gastronômico casual com produtos seletos de confeitaria, salgados tradicionais e cafés especiais.">
	<meta name="keywords" content="Salgados, Sonhos, Doces, Bolos, Buffet, Almoço, Lanches, Bebidas, Sobremesas, Jantar, Marmita.">
	<meta name="robots" content="">
	<meta name="revisit-after" content="1 day">
	<meta name="language" content="Portuguese">
	<meta name="generator" content="N/A">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	
</head>
<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/cardapio/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/cardapio/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/cardapio/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/cardapio/style-lg.css"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.all.min.js" integrity="sha256-VkcwHXtZS2ZHfHSFSP8r1AzueZi37jGMPeHv4OfV1Cg=" crossorigin="anonymous"></script>


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
				$corSec = "#C6151F";

				if($key == 0){	
					echo "
						<li class='nav-item active'><a class= 'nav-link item-categoria' href='#categoria".$categoria->getPkId()."' id='".$categoria->getPkId()."' style='border-bottom: 2px solid ".$corSec.";' onMouseOver='this.style.borderBottomColor=".$corSec."'>
							<div style='color:".$corSec."'>".$categoria->getNome()."</div>
						</a></li>";
				}else{
					echo "
						<li class='nav-item'><a class= 'nav-link item-categoria' href='#categoria".$categoria->getPkId()."' id='".$categoria->getPkId()."' >
							<div style='color:".$corSec."'>".$categoria->getNome()."</div>
						</a></li>";
				}

			}

		?>
		</ul>
      </div>

		</div>
</nav>

	<div class="container produtos" id="container-produtos" data-spy="scroll" data-target=".menu-lateral" data-offset="120px">
		

	</div>

		
	<div class="scroll-top">
	
		<a href="#top">

			<i class="far fa-caret-square-up" style="color: <?=$corSec?>"></i>

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
		$('body').scrollspy({ 
			target: '#navbar-cardapio'
		});
		// $('[data-spy="scroll"]').each(function () {
		// 	var $spy = $(this).scrollspy('refresh')
		// });

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
		//Scroll horizontal dos itens do menu de categorias 
		$("#navbar-cardapio").on('activate.bs.scrollspy', event => {
			let telaW = (window.innerWidth/2);
			let elementoW = ($(event.target)[0].offsetWidth/2); 
			$('#navbar-cardapio > div')[0].scrollLeft = ($(event.target)[0].offsetLeft - telaW)+ elementoW;
			
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


		//Todos adicionais
		var adicionais = JSON.parse('<?php echo json_encode($adicionais); ?>');
		// console.log(adicionais);

		$(document).on('click', '.add', function () {
			$(this).prev().val(+$(this).prev().val() + 1);
		});
		$(document).on('click', '.sub', function () {
			if ($(this).next().val() > 0){
				$(this).next().val(+$(this).next().val() - 1);
			}
		});
		
		$(document).on("click", "#addCarrinho", function(){

			var qtd = $('#spanCarrinho').text();
			var id = $(this).data('cod');
			var src = $(this).data('src_image');

			const nomeItem = $('#tituloNome'+id).text();

			//Adicionais relacionados ao produto
			var adicionais_produto = $(this).data('arr_adicionais');
			if(!adicionais_produto){
				var adicionais_produto = [];
			}
			
			//Atribui os adicionais a um array.
			var array_adicionais =[];
			adicionais.forEach(function(value, key){
				var id_aux = value['adi_pk_id'];
				array_adicionais[id_aux] = [value['adi_nome'], value['adi_preco']];
			});

			//Verifica se existe adicionais, se não apenas exibe input de observação.
			var div_complemento = "";
			if(adicionais_produto !== [] && adicionais_produto.length > 0 
			&& adicionais_produto.length !== null && adicionais_produto !== '' && adicionais_produto){
				div_complemento += `<h4 style='font-weight: bold;'>Algum complemento?</h4>`;
			}else{
				div_complemento += `<h4 style='font-weight: bold;'></h4>`
			}
			
			//Atribui o elemento com os adicionais na janela do sweetalert a variavel
			var adicionais_html = "";
			adicionais_produto.forEach(function(pk_id, chave){
				adicionais_html += `
				<li>
					<div class="qtd-adicionais">
						<button type="button" id="sub" class="sub">-</button>
						<input 
							type="text" value="0" name='qtd-adic[]' class="field qtd-adic" readonly
							data-id='${pk_id}' data-nome='${array_adicionais[pk_id][0]}' data-preco='${array_adicionais[pk_id][1]}'
						/>
						<button type="button" id="add" class="add">+</button>
						${array_adicionais[pk_id][0]} - R$ ${array_adicionais[pk_id][1]}
					</div>
				</li>`
			})
			let html = `
			<br>
			<div class='imagem'>
                    
                    <img class='img-responsive'  src='${src}' onerror='this.src=\"/home/img/default_produto.jpg\"'>
                </div>
			<div class='adicionais-wrapper'>
				${div_complemento}
					<ul style="list-style-type: none;">
						${adicionais_html}
					</ul> 
				
			</div>
			<div>
				<h4 style='font-weight: bold;padding-top:10px;'>Alguma observação?</h4>
			</div>
			`;
			
			

			Swal.fire({
				input: 'text',
				inputPlaceholder: 'Exemplo: Sem queijo...',
				html: html
				
				
			})
			.then((observacaoItem) => {

				//Adicionais selecionados do Produto
				var adicionais_selecionados = [];

				$('.qtd-adic').each(function(){
					if($(this).val() > 0){
						adicionais_selecionados.push 
							([
								$(this).data('id'),
								$(this).data('nome'),
								$(this).data('preco'),
								$(this).val()
							]);
					}
				})

				$.ajax({
					type: 'GET',
					url: 'ajax/add-carrinho.php',
					data: {observacaoItem: observacaoItem['value'], id: id, adicionais_selecionados: adicionais_selecionados},
					success:function(resObs){
						$("#spanCarrinho").html(resObs);
						$("#spanCarrinho-navbar").html(resObs);
						$("#spanCarrinho-barra").html(resObs);

						if(qtd == resObs){
							Swal.fire({
								title: "Item já Adicionado! 😋",
								text: "Consulte o carrinho...",
								icon: "warning",
								timer: 1100,
								buttons: false
							});
						}else{
							Swal.fire({
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

		function onHover(elem){

		}
		

	</script>

</body>

</html>