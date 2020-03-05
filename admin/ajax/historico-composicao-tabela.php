<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlComposicao.php";
include_once MODELPATH."/usuario.php";

protegePagina();

$controle=new controlerComposicao($_SG['link']);
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

			$higr_data = date_create($higr["higr_data"]);
			$higr_data = date_format($higr_data, "d/m/Y H:i:s");
			
			$pk_igr = $higr['higr_fk_ingrediente'];
			
			//valores calculados p/ Ingrediente p/ data
			array_push(
				$valores_ingr_calc_his,
				[
					"pk_igr" => $pk_igr,
					"nome" => $higr['igr_nome'],
					"data" => $higr_data,
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

				$historico_composicoes[$composicao->getPkId()][$i] = [$data_atual, $preco_custo];
				$i++;
			}
			
		}

		// var_dump($historico_composicoes);
		// exit;
		
		echo "<td style='text-align: center;' name='preco_custo'>";
		
		foreach($historico_composicoes[$composicao->getPkId()] as $his){
			
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
			<td style='text-align: center;' name='valor_venda'>R$ ".$valor_v."</td>";
		echo "</tr>";
	}
}else{

}
echo "</tbody></table>";

?>