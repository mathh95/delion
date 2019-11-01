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

			<form method="POST" id="cadastro-form" onsubmit="return false;" >
				
				<p>Cadastro de cliente</p>
				
				<div class="form-row">
					<div class="col-md-6 col-sm-12 col-xs-12">
						
						<p>Nome:</p>

						<input class="form-control" name="nome" type="text" minlength="3" maxlength="30" required placeholder="Delion" autofocus>

					</div>
					
					<div class="col-md-6 col-sm-12 col-xs-12">
						
						<p>Sobrenome:</p>

						<input class="form-control" name="sobrenome" type="text" minlength="3" maxlength="30" required placeholder="Oliveira">

					</div>
				</div>

    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>CPF:</p>

        			<input class="form-control cpf" name="cpf" type="text" minlength="11" maxlength="14" required placeholder="999.999.999-99">

				</div>

    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Data Nascimento:</p>

					<?php
						$current = date("Y-m-d");
						$min = date('Y-m-d', strtotime($current.'-90 year'));
						$max = date('Y-m-d', strtotime($current.'-12 year'));

						echo '
						<input class="form-control data_nasc" name="data_nasc" type="date" minlength="8" maxlength="10" min="'.$min.'" max="'.$max.'" required>
						';
					?>

				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					
					<p>Celular:</p>

					<input class="form-control telefone" name="telefone" type="text" minlength="8" maxlength="16" required placeholder="(45) 9 9999-9999">

				</div>

				<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Login (e-mail):</p>

        			<input class="form-control" name="login" type="email" minlength="4" maxlength="40" required placeholder="delion@mail.com">

				</div>

				<div class="col-md-6 col-sm-12 col-xs-12">

					<p>Senha:</p>

					<input class="form-control" name="senha" type="password" minlength="4" maxlength="40" required placeholder="******">

				</div>

				<div class="col-md-6 col-sm-12 col-xs-12">

					<p>Confirmar Senha:</p>

					<input class="form-control" name="senha2" type="password" minlength="4" maxlength="40" required placeholder="******">

				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">

					<button type="submit" id="cadastrar">CADASTRAR</button>
					
				</div>

			</form>

		</div>

		

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
			}else if(data[5].value == ""){
				return;
			}else if(data[6].value == ""){
				return;
			}else if(data[7].value == ""){
				return;
			}else{

				data.push({name: "is_verificacao_cadastro", value: "1"});

				//verifica dados e envia sms
				$.post({
					url: 'controler/businesCliente.php',
					data: data,
					success: function(resultado){
						console.log(resultado);

						if(resultado.includes("verificado")){

							swal({
								title: 'SMS Enviado!',
								text: 'Assim que receber insira o código para finalizar o cadastro.',
								content: "input",
								button: {
									text: "Prosseguir",
									closeModal: false,
								},
							})
							.then(cod => {
								if (!cod) throw null;
								
								//remove flag de verificacao
								data.pop();
								inserirCliente(data, cod);
							})
							.catch(err => {
								if (err) {
									swal("Erro :/", "Erro interno...", "error");
								} else {
									swal.stopLoading();
									swal.close();
								}
							});

						}else{
							swal("Erro :/", resultado , "error");
						}
					},
					error: function(resultado){
						console.log(resultado);
						swal("Erro :/", "Entre em contato com o suporte." , "error");
					}
				});
			}
		});

		//Insere cliente após verificação de dados e SMS
		function inserirCliente(data, cod){

			data.push({name: "codigo_sms", value: cod});
			data.push({name: "is_cadastro", value: "1"});

			$.post({
				url: 'controler/businesCliente.php',
				data: data,
				success: function(resultado){
					console.log(resultado);
					if(resultado.includes("inserido")){
						//redireciona para boas vindas
						window.location = "/home?bem_vindo=true";
					}else{
						swal("Erro :/", resultado , "error");
					}
				},
				error: function(resultado){
					console.log(resultado);
					swal("Erro :/", "Entre em contato com o suporte." , "error");
				}
			});
		}

		$(document).ready(function(){
			$(".cpf").mask("999.999.999-99");
			// $(".telefone").mask("(45) 99999-9999)");
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

		$('.timepicker-inicio').wickedpicker({

		twentyFour: true

		});

		$('.timepicker-termino').wickedpicker({

		twentyFour: true

		});

	</script>

</body>

</html>