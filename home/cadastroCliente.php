<?php 
	
	session_start();

	include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";

	$controleEmpresa = new controlerEmpresa(conecta());
	$empresa = $controleEmpresa->select(1,2);

	//configuração de acesso ao WhatsApp
	//include "./whats-config.php";
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
						
						<p>Nome*</p>

						<input class="form-control" name="nome" type="text" minlength="3" maxlength="30" required placeholder="Delion" autofocus>

					</div>
					
					<div class="col-md-6 col-sm-12 col-xs-12">
						
						<p>Sobrenome*</p>

						<input class="form-control" name="sobrenome" type="text" minlength="3" maxlength="30" required placeholder="Oliveira">

					</div>
				</div>

    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>CPF*</p>

        			<input class="form-control cpf" name="cpf" type="text" minlength="11" maxlength="14" required placeholder="999.999.999-99">

				</div>

    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Data Nascimento*</p>

					<?php
						$current = date("Y-m-d");
						$min = date('Y-m-d', strtotime($current.'-100 year'));
						$max = date('Y-m-d', strtotime($current.'-12 year'));

						echo '
						<input class="form-control data_nasc" name="data_nasc" type="date" minlength="8" maxlength="10" min="'.$min.'" max="'.$max.'" required>
						';
					?>

				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					
					<p>Celular*</p>

					<input class="form-control telefone" name="telefone" type="text" minlength="15" maxlength="15" required placeholder="(45) 9 9999-9999">

				</div>

				<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Login (e-mail)*</p>

        			<input class="form-control" name="login" type="email" minlength="4" maxlength="40" required placeholder="delion@mail.com">

				</div>

				<div class="col-md-6 col-sm-12 col-xs-12">

					<p>Senha*</p>

					<input class="form-control" name="senha" type="password" minlength="4" maxlength="40" required placeholder="******">

				</div>

				<div class="col-md-6 col-sm-12 col-xs-12">

					<p>Confirmar Senha*</p>

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

	
	<!-- reCAPTCHAv3 -->
	<script src="https://www.google.com/recaptcha/api.js?render=<?=GOOGLE_reCAPTCHA?>"></script>

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
			
			// reCAPTCHAv3
			grecaptcha.ready(function() {
				grecaptcha.execute('<?=GOOGLE_reCAPTCHA?>',
				{action: 'verificar_cliente'})
				.then(function(token)
				{
					//adiciona token ao array POST
					data.push({name: "grecaptcha_token_verificar", value: token});
					//empilha! flag de verificacao
					data.push({name: "is_verificacao_cadastro", value: "1"});

					verificaCliente(data);
				});
			});
		}
	});

	//verifica dados e envia sms
	function verificaCliente(data){
		$.post({
			url: 'controler/businesCliente.php',
			data: data,
			success: function(resultado){
				console.log(resultado);
				
				if(resultado.includes("verificado")){

					getCodigoSms();

				}else{
					swal("Erro 😕", resultado , "error");
				}
			},
			error: function(resultado){
				console.log(resultado);
				swal("Erro 😕", "Entre em contato com o suporte." , "error");
			}
		});
	}

	function getCodigoSms(){

		swal({
			title: 'SMS Enviado!',
			text: 'Insira o código recebido abaixo.',
			content: "input",
			button: 'Prosseguir'
		})
		.then(cod_sms => {
			if (!cod_sms) throw null;
			if (cod_sms.length < 4){
				swal("Código inválido!", "warning");
			}else{
				//remove flag de verificacao
				data.pop();

				// reCAPTCHAv3
				grecaptcha.ready(function() {
					grecaptcha.execute('<?=GOOGLE_reCAPTCHA?>',
					{action: 'cadastrar_cliente'})
					.then(function(token)
					{
						//adiciona token ao array POST
						data.push({name: "grecaptcha_token_cadastrar", value: token});

						data.push({name: "codigo_sms", value: cod_sms});
						data.push({name: "is_cadastro", value: "1"});

						inserirCliente(data);
					});
				});
			}
		})
		.catch(err => {
			if (err) {
				swal("Erro 😕", err , "error");
			} else {
				swal.stopLoading();
				swal.close();
			}
		});
	}

	//Insere cliente após verificação de dados e SMS
	function inserirCliente(data){

		$.post({
			url: 'controler/businesCliente.php',
			data: data,
			success: function(resultado){
				console.log(resultado);
				if(resultado.includes("inserido")){
					//redireciona para boas vindas
					window.location = "/home?bem_vindo=true";
				}else{
					swal("Erro 😕", resultado , "error");
				}
			},
			error: function(resultado){
				console.log(resultado);
				swal("Erro 😕", "Entre em contato com o suporte." , "error");
			}
		});
	}

	$(document).ready(function(){
		$(".cpf").mask("999.999.999-99");
		// $(".telefone").mask("(45) 99999-9999)");
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