<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlComposicao.php";
include_once CONTROLLERPATH."/controlProduto.php";

include_once MODELPATH."/usuario.php";

protegePagina();

$controle = new controlerComposicao($_SG['link']);
$controle_produto = new controlerProduto($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);

$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);


$composicoes = $controle->selectAll();
	

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('gerenciar_composicao', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1>Historico de Produtos</h1>
		<tr>
		<th width='5%' style='text-align: center;'>#ID</th>
            <th width='25%' style='text-align: center;'>Nome do Produto</th>
			<th width='10%' style='text-align: center;'>Preço de Custo</th>
			<th width='5%' style='text-align: center;'>Custo Extra</th>
			<th width='5%' style='text-align: center;'>Custo Total</th>
			<th width='5%' style='text-align: center;'>Valor de Venda</th>
			<th width='5%' style='text-align: center;'>Histórico</th>
			</tr>
	<tbody>";


	$historico_composicoes = [];
	foreach ($composicoes as $key_com => $composicao) {

		$higr_data_index = [];

		echo "<tr name='resultado' id='status".$composicao->getPkId()."'>

		<td style='text-align: center;' name='id'>".$composicao->getPkId()."</td>
		<td style='text-align: center;' name='nome'>".$composicao->nome_prod."</td>";


		$ingredientes_his_composicao = 
			$controle->selectHisIngrByFkComposicao($composicao->getPkId());

		$valores_ingr_calc_his = [];
		foreach ($ingredientes_his_composicao as $key_higr => $higr){
			
			$qtd_utilizada = $higr["coig_qtde_utilizada"];
			
			$pk_igr = $higr['higr_fk_ingrediente'];
			
			//valores calculados p/ Ingrediente p/ data
			array_push(
				$valores_ingr_calc_his,
				[
					"pk_igr" => $pk_igr,
					"nome" => $higr['igr_nome'],
					"data" => $higr['higr_data'],
					"valor_calc" => $higr["higr_valor"] * $qtd_utilizada
				]
			);				
		}
		
		//Inicia array de igredientes/valor_calculado
		$ingredientes_composicao = $controle->selectByFkComposicao($composicao->getPkId());
		$ingrs_val_calc = [];
		foreach($ingredientes_composicao as $key_ingr_com => $ingr_com){
			$ingrs_val_calc[$key_ingr_com] = null;
		}

		$n_ingr_composicao = count($ingrs_val_calc);
		
		$arr_ingr_somados = [];
		$i = 0;

		//Calculo Preço de Custo
		foreach($valores_ingr_calc_his as $key_ingr => $ingr_his){

			//associa valores calculados aos ingredientes
			$ingrs_val_calc[$ingr_his['pk_igr']] = $ingr_his['valor_calc'];

			//add ingredientes que já associaram o valor 
			if(!in_array($ingr_his['pk_igr'], $arr_ingr_somados)){
				$arr_ingr_somados[] = $ingr_his['pk_igr'];
			}

			//data historico ingrediente
			$data_atual = $ingr_his['data'];

			$preco_custo = 0;
			//Calc. Preço Custo Se Todos igredientes possuem valor associado
			if($n_ingr_composicao == count($arr_ingr_somados)){

				//p/ cada ingrediente
				foreach($ingrs_val_calc as $ingr_calc){
					$preco_custo += $ingr_calc;
				}

				$historico_composicoes[$composicao->getFkProduto()][$i] = [$data_atual, $preco_custo];
				$historico_custo_datas[$composicao->getFkProduto()][$i] = $data_atual;
				$historico_custo_precos[$composicao->getFkProduto()][$i] = "R$ ".number_format($preco_custo, 2);
				$i++;
			}
		}

		// var_dump($historico_composicoes);
		// exit;

		
		echo "<td style='text-align: center;' name='preco_custo'>";
		
		foreach($historico_composicoes[$composicao->getFkProduto()] as $his){

			$data = date_create($his[0]);
			$data = date_format($data, "d/m/Y");
			$preco_c = number_format($his[1], 2, ',', ' ');

			echo $data." - ";
			echo "R$ ".$preco_c;
			echo "<br>";
		}
		echo "</td>";

		$valor_e = number_format($composicao->getValorExtra(), 2, ',', ' ');
		$valor_t = number_format($preco_custo + $composicao->getValorExtra(), 2, ',', ' ');
		$valor_v = number_format($composicao->pro_preco, 2, ',', ' ');


		echo 
			"<td style='text-align: center;' name='valor_extra'>R$ ".$valor_e."</td>
			<td style='text-align: center;' name='valor_total'>R$ ".$valor_t."</td>
			<td style='text-align: center;' name='valor_venda'>R$ ".$valor_v."</td>
			<td style='text-align: center;' name='valor_venda'>
				<button class='btn btn-default' data-toggle='modal' data-target='#modalHis".$composicao->getFkProduto()."' data-id='".$composicao->getFkProduto()."'><i class='far fa-chart-bar'></i> Histórico</button></a>
			</td>";
		echo "</tr>";


		//Monta array de histórico do Valor de Venda
		$historico_produtos = $controle_produto->selectHistoricoByFkPro($composicao->getFkProduto());

		foreach($historico_produtos as $key => $his_pro){
			//Select histórico do Valor de Venda dos Produtos
			$historico_venda_datas[$composicao->getFkProduto()][$key] = $his_pro['hipr_data'];
			$historico_venda_precos[$composicao->getFkProduto()][$key] = "R$ ".number_format($his_pro['hipr_valor'], 2);

		}

		criaModal($composicao->getFkProduto(), $composicao->nome_prod);
	}
}

echo "</tbody></table>";


function criaModal($com_fk_produto, $nome_produto){
	//Cria modal de Historico para Composição/Produto
	echo
	"<div class='modal fade' style='text-align: center' id='modalHis".$com_fk_produto."' tabindex='-1' role='dialog' aria-labelledby='ModalLabel'>

		<div class='modal-dialog modal-lg' role='document'>
			<div class='modal-content'>
				<div class'modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<br>
					<h4 class='modal-title' id='ModalLabel' style='text-align:center'><b>".$nome_produto."</b></h4>
				</div>

				<div class='modal-body' style='width:100%;'>

					<div id='his".$com_fk_produto."' style='width:800px; height:400px;'></div>

				</div>

				<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
				</div>

			</div>
		</div>
	</div>";

}


?>

<script>

	var data = [];
	var historico = <?= json_encode($historico_composicoes) ?>;

	//arrays referentes ao Preço Custo
	var arr_custo_datas = <?= json_encode($historico_custo_datas) ?>;
	var arr_custo_precos = <?= json_encode($historico_custo_precos) ?>;

	//arrays referentes ao Valor de Venda
	var arr_venda_datas = <?= json_encode($historico_venda_datas) ?>;
	var arr_venda_precos = <?= json_encode($historico_venda_precos) ?>;

	// console.log(arr_datas);
	// console.log(arr_precos);

	//para cada produto
	for (var k in historico){
		// console.log(historico[k]);
		let trace_preco_custo = 
		{
			name: "Preço de Custo",
			x: arr_custo_datas[k],
			y: arr_custo_precos[k],
			type: 'scatter'
		};

		let trace_preco_venda = 
		{
			name: "Valor de Venda",
			x: arr_venda_datas[k],
			y: arr_venda_precos[k],
			type: 'scatter'
		};

		data[k] = [trace_preco_custo, trace_preco_venda];
	}
	
	//Gera gráficos por Composicao e associa as Modals
	for (var i in data){
		Plotly.newPlot('his'+i, data[i]);
	}

</script>


