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
					<!--  Botoes do sistema de resgate por pontos -->
					<div class="btn-group btn-wrapper-resgate" data-toggle="buttons">

						<label class="btn btn-light active btn-30pts" data-link_class_produtos_resgate="resgate-30pts">
							<input type="radio" name="options" id="btn-30pts" checked>
							<span>30 pontos</span>
						</label>

						<label class="btn btn-light btn-50pts" data-link_class_produtos_resgate="resgate-50pts">
							<input type="radio" name="options" id="btn-50pts">
							<span>50 pontos</span>
						</label>

						<label class="btn btn-light btn-80pts" data-link_class_produtos_resgate="resgate-80pts">
							<input type="radio" name="options" id="btn-80pts">
							<span>80 pontos</span>
						</label>

						<label class="btn btn-light btn-90pts" data-link_class_produtos_resgate="resgate-90pts">
							<input type="radio" name="options" id="btn-90pts">
							<span>90 pontos</span>
						</label>

						<label class="btn btn-light btn-120pts" data-link_class_produtos_resgate="resgate-120pts">
							<input type="radio" name="options" id="btn-120pts">
							<span>120 pontos</span>
						</label>

						<label class="btn btn-light btn-200pts" data-link_class_produtos_resgate="resgate-200pts">
							<input type="radio" name="options" id="btn-200pts">
							<span>200 pontos</span>
						</label>

						<label class="btn btn-light btn-220pts" data-link_class_produtos_resgate="resgate-220pts">
							<input type="radio" name="options" id="btn-220pts">
							<span>220 pontos</span>
						</label>

						<label class="btn btn-light btn-250pts" data-link_class_produtos_resgate="resgate-250pts">
							<input type="radio" name="options" id="btn-250pts">
							<span>250 pontos</span>
						</label>

					</div>

					<!-- Produtos do resgate com 30 pontos -->
					<div class="produtos-resgate-wrapper resgate-30pts">
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 30 PONTOS - 01 UNIDADE </h4>
							<p>30 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 30 PONTOS - 01 UNIDADE </h4>
							<p>30 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 30 PONTOS - 01 UNIDADE </h4>
							<p>30 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 30 PONTOS - 01 UNIDADE </h4>
							<p>30 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text"  value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>	
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 30 PONTOS - 01 UNIDADE </h4>
							<p>30 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>			                
					</div>


					<!-- Produtos do resgate com 50 pontos -->
					<div class="produtos-resgate-wrapper resgate-50pts" style="display: none;">
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 50 PONTOS - 01 UNIDADE </h4>
							<p>50 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 50 PONTOS - 01 UNIDADE </h4>
							<p>50 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 50 PONTOS - 01 UNIDADE </h4>
							<p>50 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 50 PONTOS - 01 UNIDADE </h4>
							<p>50 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text"  value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>	
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE 50 PONTOS - 01 UNIDADE </h4>
							<p>50 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>			                
					</div>

					<!-- Produtos do resgate com 80 pontos -->
					<div class="produtos-resgate-wrapper resgate-80pts" style="display: none;">
						<div class="produto-resgate">
							<img src="/home/img/img-cardapio.png" alt="cafe">
							<h4>CAFÉ DELION 80 PONTOS - 01 UNIDADE </h4>
							<p>80 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/img-cardapio.png" alt="cafe">
							<h4>CAFÉ DELION 80 PONTOS - 01 UNIDADE </h4>
							<p>80 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/img-cardapio.png" alt="cafe">
							<h4>CAFÉ DELION 80 PONTOS - 01 UNIDADE </h4>
							<p>80 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/img-cardapio.png" alt="cafe">
							<h4>CAFÉ DELION 80 PONTOS - 01 UNIDADE </h4>
							<p>80 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
						<div class="produto-resgate">
							<img src="/home/img/img-cardapio.png" alt="cafe">
							<h4>CAFÉ DELION 80 PONTOS - 01 UNIDADE </h4>
							<p>80 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
					</div>


					<!-- Produtos do resgate com 90 pontos -->
					<div class="produtos-resgate-wrapper resgate-90pts" style="display: none;">
						<div class="produto-resgate">
							<img src="/home/img/mini_cake.png" alt="cake">
							<h4>MINI CAKE DELION 90 PONTOS - 01 UNIDADE </h4>
							<p>90 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
					</div>

					<!-- Produtos do resgate com 120 pontos -->
					<div class="produtos-resgate-wrapper resgate-120pts" style="display: none;">
						<div class="produto-resgate">
							<img src="/home/img/mini_cake.png" alt="cake">
							<h4>MINI CAKE DELION 120 PONTOS - 01 UNIDADE </h4>
							<p>120 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
					</div>

					<!-- Produtos do resgate com 200 pontos -->
					<div class="produtos-resgate-wrapper resgate-200pts" style="display: none;">
						<div class="produto-resgate">
							<img src="/home/img/img-cardapio.png" alt="cafe">
							<h4>CAFÉ DELION 200 PONTOS - 01 UNIDADE </h4>
							<p>200 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
					</div>

					<!-- Produtos do resgate com 220 pontos -->
					<div class="produtos-resgate-wrapper resgate-220pts" style="display: none;">
						<div class="produto-resgate">
							<img src="/home/img/torta.png" alt="torta">
							<h4>CHEESECAKE DELION 220 PONTOS - 01 UNIDADE </h4>
							<p>220 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
					</div>


					<!-- Produtos do resgate com 250 pontos -->
					<div class="produtos-resgate-wrapper resgate-250pts" style="display: none;">
						<div class="produto-resgate">
							<img src="/home/img/mini_cake.png" alt="cake">
							<h4>MINI CAKE MASTER ULTRA DELION 250 PONTOS - 01 UNIDADE </h4>
							<p>250 pontos</p>
							<div class="botoes-qtd">
								<button type="button" id="sub" class="sub">-</button>
								<input type="text" value="0" class="field" disabled />
								<button type="button" id="add" class="add">+</button>
							</div>
						</div>
					</div>

					<div class="botoes-resgate">
						<button type="button" class="btn btn-secondary" onclick="location = '/home/cardapio.php'">Cancelar resgate</button>
						<button type="button" class="btn btn-success" onclick="location = '/home/cardapio.php'">Finalizar resgate</button>
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
		$('.add').click(function () {
    		$(this).prev().val(+$(this).prev().val() + 1);
		});
		$('.sub').click(function () {
			if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
		});


		$(".btn-light").click(function() {
                link_class_produtos_resgate = $(this).data("link_class_produtos_resgate");
                $( ".produtos-resgate-wrapper" ).hide();
                $('.'+link_class_produtos_resgate).slideToggle();
                
        });
	</script>

</body>

</html>