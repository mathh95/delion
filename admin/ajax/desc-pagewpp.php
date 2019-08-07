<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."admin/controler/controlCarrinhoWpp.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/controlUsuario.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerCarrinhoWpp($_SG['link']);

$cod = $_GET['cod'];

if(isset($_POST['nome']) || isset($_POST['menor']) || isset($_POST['maior']) || isset($_POST['endereco'])){ 
	$nome = $_POST['nome'];
	$menor = $_POST['menor'];
	$maior = $_POST['maior'];
	if (!empty($_POST['endereco'])){
		$endereco = $_POST['endereco'];
		$pedidos = $controle->filterEndereco($nome, $menor, $maior, $endereco);
	}else{
		$pedidos = $controle->selectAllPedido($nome, $menor, $maior);
	}
}else{
	if (!isset($_POST['nome'])){
		$nome ='';
	}
	if (!isset($_POST['menor'])){
		$menor =0;
	}
	if (!isset($_POST['maior'])){
		$maior =999999;
	}
	$pedidos = $controle->selectAllPedido($nome, $menor, $maior);
}

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if ($pedidos == -1){
	echo "<h1> SEM RESULTADOS</h1>";
}else{


if(in_array('pedidoWpp', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Dados do Pedido</h1>
		<div class=\"pull-right\">
			<a href=\"pedidoWppLista.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
		</div class=\"pull-right\">
		<tr>
    		<th width='8%' style='text-align: center;'>Nome do cliente</th>
			<th width='10%' style='text-align: center;'>Data Pedido</th>
			<th width='10%' style='text-align: center;'>Hora Pedido</th>
			<th width='10%' style='text-align: center;'>Hora Impressão</th>
			<th width='10%' style='text-align: center;'>Previsão Entrega</th>
			<th width='10%' style='text-align: center;'>Hora Delivery</th>
        </tr>
	<tbody>";
		foreach ($pedidos as &$pedido) {
				if($pedido->getCod_pedido_wpp() == $cod){
				$mensagem='Cliente excluído com sucesso!';
				$titulo='Excluir';
				
				echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
					<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
					<td style='text-align: center;' name='dataPedido'>".$pedido->getData()->format('d/m/Y')."</td>
					<td style='text-align: center;' name='horaPedido'>".$pedido->getData()->format('H:i:s')."</td>
<<<<<<< HEAD
					<td style='text-align: center;' name='horaImpressão'>".$pedido->getData()->format('H:i:s')."</td>
					<td style='text-align: center;' name='previsaoEntrega'>".$pedido->getData()->format('H:i:s')."</td>
					<td style='text-align: center;' name='horaDelivey'>".$pedido->getData()->format('H:i:s')."</td>
=======
					<td style='text-align: center;' name='horaImpressão'>".$pedido->getData()->format('d/m/Y')."</td>
					<td style='text-align: center;' name='horaDelivey'>".$pedido->getData()->format('d/m/Y')."</td>
>>>>>>> e3f4ccc1279823222b4ce4685d33299e5aa4039d
					</tr>";
				}
			}		
		}
	}
?>