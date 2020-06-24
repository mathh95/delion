<?php 
	
	session_start();
	
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
	
    include_once CONTROLLERPATH."/conexao.php";
    include_once "./controler/controlCliente.php";
    include_once "./controler/controlProduto.php";
	include_once MODELPATH."/produto.php";
	include_once MODELPATH."/cliente.php";

	include_once CONTROLLERPATH . "/controlFaixaHorario.php";
	$controle_faixa_horario = new controlerFaixaHorario(conecta());

	$control_cliente = new controlCliente(conecta());
	$controle_produto = new controlerProduto(conecta());
	
	//configuração de acesso ao WhatsApp
	//include "./whats-config.php";

	//Verifica se usuário já habilidato para o Programa
	if(!isset($_SESSION['data_nasc']) ||  $_SESSION['data_nasc'] == "") header("Location: /home/cadastroFidelidade.php");
	//var_dump($_SESSION);

	$cliente = $control_cliente->selectById($_SESSION['cod_cliente']);

	//pontos da promocao
	$array_pontos = array(30, 50, 80, 90, 120, 200, 220, 250);

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
					<div class="pontos-wrapper">
						<p>Você possui: <span><?=floor($cliente->getPontosFidelidade())?> pontos</span></p>
						<p>Pontuação mínima: <span>30 pontos</span></p>
						<p>Pontuação utilizada: <span> <span id="pts-utlizados">0</span> pontos</span></p>
					</div>

				</div>

				<div class="tabela-produtos">
					<div class="produtos-titulo">
						Produtos para Resgate
					</div>
					<!--  Botoes do sistema de resgate por pontos -->
					<div class="btn-group btn-wrapper-resgate" data-toggle="buttons">

						<?php

						$is_active = "active";
						foreach($array_pontos as $pontos){

							if($pontos != 30) $is_active = "";

							echo "
								<label class='btn btn-light {$is_active} btn-{$pontos}pts' data-link_class_produtos_resgate='resgate-{$pontos}pts'>
								<input type='radio' name='options' id='btn-{$pontos}pts' checked>
								<span>{$pontos} pontos</span>
							</label>
							";
						}
						?>

					</div>

					<?php

					// $hora_atual = date('H:i:s', time() - 3600); // horário de verão extinto
					$hora_atual = date('H:i:s', time()); // servidor possui hora correta
					$hoje = (date('w')+1); // 1 == domingo, 7 == sábado

					$is_hide = "";
					foreach($array_pontos as $pontos){
						
						$itens = $controle_produto->selectAllByPtsResgate($pontos);
						
						
						if($pontos != 30) $is_hide = 'style="display:none;"';
						echo "
						<div {$is_hide} class='produtos-resgate-wrapper resgate-{$pontos}pts'>
						";

						$flag_displayed = false;

						foreach($itens as $item){

							if(
								$item->getFlag_ativo()
							){

								echo "
								<div class='produto-resgate'>
									<img src='../admin/{$item->getFoto()}' alt='{$item->getNome()}' onerror='this.src=\"/home/img/default_produto.jpg\"'>
									<h4>{$item->getNome()} </h4>
									<p>{$pontos} pontos</p>";

								// Disponibilidade
								$disponivel_agora = false;
								$arr_dias_disponiveis = $item->getDias_semana();

								$faixas_horario = $controle_faixa_horario->selectByFkProduto($item->getPkId());

								// Se disponível todos os horários
								if (count($faixas_horario) == 0) {
									$disponivel_agora = true;
								}
								// Se disponível agora(horário)
								foreach ($faixas_horario as $key_fh => $faixa) {

									if (
										($hora_atual >= $faixa->getInicio() &&
											$hora_atual < $faixa->getFinal())
									) {
										$disponivel_agora = true;
									}
								}
								// Se disponível hoje e agora(horário) 
								if (
									$arr_dias_disponiveis &&
									in_array($hoje, json_decode($arr_dias_disponiveis)) &&
									$item->getFlag_servindo() &&
									$disponivel_agora
								) {
									$disponivel_agora = true;
								} else {
									$disponivel_agora = false;
								}

								if ($disponivel_agora) {


									echo
									"<div class='botoes-qtd'>

										<button
											type='button' id='sub'
											data-cod_produto='{$item->getPkId()}'
											data-pontos='{$item->getPtsResgateFidelidade()}'
											class='sub'>-
										</button>
										
										<input id='qtd-{$item->getPkId()}' type='text' value='0' class='field' disabled />
										
										<button
											type='button' id='add'
											data-cod_produto='{$item->getPkId()}'
											data-pontos='{$item->getPtsResgateFidelidade()}'
											data-nome_produto='{$item->getNome()}' class='add'>+
										</button>

									</div>";
			
									}else{
										echo "Indiponível no Momento👩‍🍳";
									}


								echo "</div>";

								$flag_displayed = true;

							}else{
								
								if($flag_displayed == false){
									echo '<div style="text-align:center; padding:10px;">Itens indisponíveis no momento! <i class="far fa-surprise"></i></div>';

									$flag_displayed = true;
								}
							}	
						}

						echo "</div>";
					}

					?>

					<div class="botoes-resgate">
						<button type="button" class="btn btn-secondary" onclick="location = '/home/cardapio.php'">Cancelar resgate</button>
						<button type="button" class="btn btn-success" id="finalizar_resgate">Finalizar resgate</button>
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

		var pontos_disponiveis = <?=floor($cliente->getPontosFidelidade())?>;
		var pontos_usados = 0;
		
		var itens_resgate = {};
		

		$(document).on("click","#finalizar_resgate", function(){
						
			var qtd_carrinho = $('#spanCarrinho').text();

			console.log(itens_resgate);
			if(itens_resgate.length == 0){
				swal({
					title: "Nenhum item selecionado 😮",
					icon: "info",
					button: 'Voltar'
				});
				return;
			}

			swal({
				title: "Finalizar resgate!? 😋",
				text: "Indo para o carrinho...",
				icon: "info",
				buttons: {
					cancel: {
						text: 'Voltar',
						visible: true,
						value: false,
					},
					confirm: {
						text: 'Prosseguir',
						value: true,
					}
				}
			})
			.then((val) => {
				if(val){
					$.ajax({
						type: 'GET',
						url: 'ajax/add-carrinho.php',
						data: {is_array: true, itens_resgate: itens_resgate},
						success: function(res){
							console.log(res);
							// return;
							$("#spanCarrinho").html(res);
							$("#spanCarrinho-navbar").html(res);

							window.location = 'carrinho.php';
						},
						error: function(err){
							console.log(err);
						}
					});
				}
			});

		});




		$('.add').click(function () {

			pts = $(this).data('pontos');

			aux = pontos_usados + pts;
			if(aux > pontos_disponiveis){
				displayPtsInsuficientes();
				return;
			}else{

				var id = $(this).data('cod_produto');
				var qtd_item = parseInt($("#qtd-"+id).val());

				//set item p/ resgate
				if(qtd_item == 0 ) itens_resgate[id] = 0;
				$(this).prev().val(+$(this).prev().val() + 1);

				//inc qtd de item
				itens_resgate[id] += 1;

				pontos_usados += pts;
				$("#pts-utlizados").html(pontos_usados);
				// console.log(pontos_usados);
			}
			// console.log(itens_resgate);
		});


		$('.sub').click(function () {

			var id = $(this).data('cod_produto');
			var qtd_item = parseInt($("#qtd-"+id).val());

			if(qtd_item > 0){
				pts = $(this).data('pontos');
				pontos_usados -= pts;
			}
			// console.log(pontos_usados);

			//atualiza txt/val
			if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);

			//remove id do array de itens para resgate
			qtd_item = parseInt($("#qtd-"+id).val());
			if(qtd_item == 0 ){				
				delete itens_resgate[id];
			}else{
				itens_resgate[id] -= 1;
			}

			$("#pts-utlizados").html(pontos_usados);
			// console.log(itens_resgate);

		});

		function displayPtsInsuficientes(){
			swal({
				title: "Pontos insuficiente! 😕",
				text: "Tente outro produto...",
				icon: "warning",
				timer: 1100,
				buttons: false
			});
		}



		$(".btn-light").click(function() {
			link_class_produtos_resgate = $(this).data("link_class_produtos_resgate");
			$( ".produtos-resgate-wrapper" ).hide();
			$('.'+link_class_produtos_resgate).slideToggle();
                
        });
		
	</script>

</body>

</html>