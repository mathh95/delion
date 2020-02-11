
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
$total = 0;

if(isset($_POST['nome']) || isset($_POST['tipoFornecedor']) || isset($_POST['dt_inicio']) || isset($_POST['dt_fim'])){
	$nome_fornecedor = $_POST['nome'];
	$tipo = $_POST['tipoFornecedor'];
	$dt_inicio = $_POST['dt_inicio'];
	$dt_fim = $_POST['dt_fim'];

		//Filtro apenas para o nome
		if(!empty($_POST['nome']) && empty($_POST['tipoFornecedor']) && empty($_POST['dt_inicio']) && empty($_POST['dt_fim'])){
			$pedidoFornecedores = $controle->filtroNome($nome_fornecedor);
		}


		//Filtro apenas para o tipo
		else if(empty($_POST['nome']) && !empty($_POST['tipoFornecedor']) && empty($_POST['dt_inicio']) && empty($_POST['dt_fim'])){
			$pedidoFornecedores = $controle->filtroTipo($tipo);
		}
		//Filtro para o tipo "TODOS"
		else if($tipo == 0){
			$pedidoFornecedores = $controle->selectAll();
		}

		//Filtro para o nome e o tipo juntos
		else if(!empty($_POST['nome']) && !empty($_POST['tipoFornecedor']) && empty($_POST['dt_inicio']) && empty($_POST['dt_fim'])){
			$pedidoFornecedores = $controle->filtroNomeTipo($nome_fornecedor, $tipo);
		}

		//Filtro apenas para a data
		else if(empty($_POST['nome']) && empty($_POST['tipoFornecedor']) && !empty($_POST['dt_inicio']) && !empty($_POST['dt_fim'])){
			$pedidoFornecedores = $controle->filtroData($dt_inicio, $dt_fim);
		}

		else if( (empty($_POST['dt_inicio']) && !empty($_POST['dt_fim'])) || (!empty($_POST['dt_inicio']) && empty($_POST['dt_fim']))){
			echo "<h1>PREENCHA AS DUAS DATAS PARA CONCLUIR A BUSCA</h1>";
			$pedidoFornecedores = $controle->filtroNomeTipo($nome_fornecedor, $tipo);
		}

		//Filtro de todos os campos
		else if(!empty($_POST['nome']) && !empty($_POST['tipoFornecedor']) && !empty($_POST['dt_inicio']) && !empty($_POST['dt_fim'])){
			$pedidoFornecedores = $controle->filtro($nome_fornecedor, $tipo, $dt_inicio, $dt_fim);
		}


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
			echo "<table class='table table-responsive' id='tbPedidoFornecedor style='text-align = center;'>
			<thead>
				<h1 class=\"page-header\">Lista de pedidos p/ fornecedor</h1>
				<tr>
					<th width='10%' style='text-align: center;'>Tipo</th>
					<th width='17%' style='text-align: center;'>Fornecedor</th>
					<th width='10%' style='text-align: center;'>Valor</th>
					<th width='17%' style='text-align: center;'>Forma de Pagamento</th>
                    <th width='15%' style='text-align: center;'>Data do Pedido</th>
				</tr>
            <tbody>";
            
		
			foreach ($pedidoFornecedores as &$pedidoFornecedor) {
                $total += $pedidoFornecedor->getValor();
                $total = number_format($total,2,'.', '.');
				echo "<tr name='resutaldo' id='status".$pedidoFornecedor->getPkId()."'>
				<td style='text-align: center;' name='tipo'>".$pedidoFornecedor->tipo_fornecedor."</td>
				<td style='text-align: center;' name='fornecedor'>".$pedidoFornecedor->fornecedorNome."</td>
				<td style='text-align: center;' name='valor'>".$pedidoFornecedor->getValor()."</td>
				<td style='text-align: center;' name='formaPgt'>".$pedidoFornecedor->getFormaPgt()."</td>
                <td style='text-align: center;' name='qtddias'>".date('d/m/Y', strtotime($pedidoFornecedor->getDtPedido()))."</td>
			</tr>";
            }
            echo "<table class='table table-responsive' id='tbPedidoFornecedor style='text-align = center;'>
			<thead>
				<tr>
                    <th width='10%' style='text-align: center;'>Total</th>
                    <th width='10%' style='text-align: center;'>R$ ".number_format($total,2,'.', '.')."</th>
				</tr>
            <tbody>";
		}
	}

echo "</tbody></table>";
?>
