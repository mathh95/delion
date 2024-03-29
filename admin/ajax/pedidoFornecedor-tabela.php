
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlPedidoFornecedor.php";
include_once MODELPATH."/pedido_fornecedor.php";
include_once CONTROLLERPATH."/controlTipoFornecedor.php";
include_once MODELPATH."/tipo_fornecedor.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/controlUsuario.php";

protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controltipoFornecedor = new controlerTipoFornecedor($_SG['link']);
$tipo_fornecedores = $controltipoFornecedor->selectAll();
$controle=new controlerPedidoFornecedor($_SG['link']);

if(isset($_POST['nome']) || isset($_POST['tipoFornecedor']) || isset($_POST['dt_ped_inicio']) || isset($_POST['dt_ped_fim']) || isset($_POST['dt_venc_ini']) || isset($_POST['dt_venc_fim'])){
	$nome_fornecedor = $_POST['nome'];
	$tipo = $_POST['tipoFornecedor'];
	$dt_inicio = $_POST['dt_ped_inicio'];
	$dt_fim = $_POST['dt_ped_fim'];
	$dt_venc_ini = $_POST['dt_venc_ini'];
	$dt_venc_fim = $_POST['dt_venc_fim'];


		$pedidoFornecedores = $controle->filtro(
										$nome_fornecedor,
										$tipo,
										$dt_inicio,
										$dt_fim,
										$dt_venc_ini,
										$dt_venc_fim
										);

//Sem Filtro
}else{

	if(!isset($_POST['nome'])){
		$nome = '';
	}

	if(!isset($_POST['tipoFornecedor'])){
		$tipo = 0;
	}


	$pedidoFornecedores = $controle->selectAll();
}


	$permissao =  json_decode($usuarioPermissao->getPermissao());

	if($pedidoFornecedores == -1){
		echo "<h1> SEM RESULTADOS</h1>";
	}else{

		if(in_array('gerenciar_fornecededor', $permissao)){
		
		}else{
			echo "
			<div class='table-responsive'>
			<table class='table' id='tbPedidoFornecedor style='text-align = center;'>
			<thead>
				<h1 >Lista de pedidos p/ fornecedor</h1>
				<tr>
					<th width='10%' style='text-align: center;'>Tipo</th>
					<th width='17%' style='text-align: center;'>Fornecedor</th>
					<th width='10%' style='text-align: center;'>Valor</th>
					<th width='17%' style='text-align: center;'>Forma de Pagamento</th>
					<th width='20%' style='text-align: center;'>Descrição (Opcional)</th>
					<th width='15%' style='text-align: center;'>Data do Pedido</th>
					<th width='15%' style='text-align: center;'>Data Vencimento</th>
					<th width='10%' style='text-align: center;'>Editar</th>
				</tr>
			<tbody>";
		
			foreach ($pedidoFornecedores as &$pedidoFornecedor) {
				$diasVencimento = $pedidoFornecedor->dtVencimento;
				$dtVenc = $date = strtotime("+{$diasVencimento} day", strtotime($pedidoFornecedor->getDtPedido()));
				echo "<tr name='resutaldo' id='status".$pedidoFornecedor->getPkId()."'>
				<td style='text-align: center;' name='tipo'>".$pedidoFornecedor->tipo_fornecedor."</td>
				<td style='text-align: center;' name='fornecedor'>".$pedidoFornecedor->fornecedorNome."</td>
				<td style='text-align: center;' name='valor'>".$pedidoFornecedor->getValor()."</td>
				<td style='text-align: center;' name='formaPgt'>".$pedidoFornecedor->getFormaPgt()."</td>
				<td style='text-align: center;' name='descricao'>".substr(html_entity_decode($pedidoFornecedor->getDesc()), 0, 200)."</td>
				<td style='text-align: center;' name='qtddias'>".date('d/m/Y', strtotime($pedidoFornecedor->getDtPedido()))."</td>
				<td style='text-align: center;' name='dtvenc'>".date("d/m/Y", $dtVenc)."</td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoFornecedor-view.php?cod=".$pedidoFornecedor->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
			</tr>";
			}
		}
	}

echo "</tbody></table>
</div>";
?>
