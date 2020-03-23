<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCarrinho.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/controlUsuario.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerCarrinho($_SG['link']);

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
		$maior = 999999;
	}
	$pedidos = $controle->selectAllPedido($nome, $menor, $maior);
}

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if ($pedidos == -1){
	echo "<h1> SEM RESULTADOS</h1>";
}else{


if(in_array('pedido', $permissao)){
	echo "
	<div class='table-responsive'>
		<table class='table' id='tbUsuarios' style='text-align = center;'>
		<thead>
			<h1 >Dados do Pedido</h1>
		<div class=\"pull-right\">
			<a href=\"pedidoLista.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
		</div class=\"pull-right\">
		<tr>
    		<th width='8%' style='text-align: center;'>Nome do cliente</th>
			<th width='10%' style='text-align: center;'>Data Pedido</th>
			<th width='10%' style='text-align: center;'>Hora Pedido</th>
			<th width='10%' style='text-align: center;'>Hora Impressão</th>
			<th width='10%' style='text-align: center;'>Previsão Entrega</th>
			<th width='10%' style='text-align: center;'>Hora Delivery/Retirada</th>
        </tr>
	<tbody>";
		foreach ($pedidos as &$pedido) {
				if($pedido->getPkId() == $cod){
				$mensagem='Cliente excluído com sucesso!';
				$titulo='Excluir';
				$impressao1 = strtotime($pedido->getHora_print());
				if($pedido->getHora_print() == ""){
					$impressao = null;
				}
				else {
					$impressao = date('H:i', $impressao1);
				}
				$delivery1 = strtotime($pedido->getHora_delivery());
				if($pedido->getHora_delivery() == ""){
					$delivery = null;
				}else{
					$delivery = date('H:i', $delivery1);
				}
				$retirada1 = strtotime($pedido->getHora_retirada());
				if($pedido->getHora_retirada() == ""){
					$retirada = null;
				}else{
					$retirada = date('H:i', $retirada1);
				}

				if($pedido->getTempo_entrega() != 0){
					$tempo_entrega = $pedido->getTempo_entrega();
				}else{
					$tempo_entrega = 30;//default
				}
				
				$entrega = date('H:i', strtotime($pedido->getData()->format('H:i')." +".$tempo_entrega." minutes"));
				echo "<tr name='resultado' id='status".$pedido->getPkId()."'>
					<td style='text-align: center;' name='cliente'>".$pedido->getCliente()."</td>
					<td style='text-align: center;' name='dataPedido'>".$pedido->getData()->format('d/m/Y')."</td>
					<td style='text-align: center;' name='horaPedido'>".$pedido->getData()->format('H:i')."</td>
					<td style='text-align: center;' name='horaImpressão'>".$impressao."</td>
					<td style='text-align: center;' name='previsaoEntrega'>".$entrega."</td>";
					if($pedido->rua == NULL){
						echo "<td style='text-align: center;' name='horaDelivery'>".$retirada."</td>";
					}else{
						echo "<td style='text-align: center;' name='horaDelivery'>".$delivery."</td>";

					}
					echo "</tr>";
				}
			}		
		}
	}
	echo "</tbody></table>
		</div>";
?>