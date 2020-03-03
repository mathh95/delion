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
// $selectFkComposicao = $controle->selectByFkComposicao();


// var_dump($composicoes);
// exit;

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('gerenciar_composicao', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1>Historico de Produtos</h1>
		<tr>
		<th width='5%' style='text-align: center;'>#ID</th>
            <th width='25%' style='text-align: center;'>Nome do Produto</th>
			<th width='25%' style='text-align: center;'>Ingredientes</th>
			<th width='5%' style='text-align: center;'>Preço de Custo</th>
			<th width='5%' style='text-align: center;'>Valor Extra</th>
			<th width='5%' style='text-align: center;'>Total</th>
			<th width='15%' style='text-align: center;'>Data Alteração</th>
        </tr>
	<tbody>";
	
	foreach ($composicoes as $key=>$composicao) {
		
		echo "<tr name='resultado' id='status".$composicao->getPkId()."'>
		<td style='text-align: center;' name='id'>".$composicao->getPkId()."</td>
		<td style='text-align: center;' name='nome'>".$composicao->nome_prod."</td>";
		
		$ingredientes_composicao = $controle->selectByFkComposicao($composicao->getPkId());
		$valor_custo = 0;
		echo "<td style='text-align: center;' name='ingredientes'>";
		foreach ($ingredientes_composicao as $key => $ingr){
			$qtd_utilizada = $ingr["coig_qtde_utilizada"];
			$valor_ingrediente = $ingr["igr_valor"];
			$valor_calculado = $valor_ingrediente * $qtd_utilizada;

			$valor_custo += $valor_calculado;

			// var_dump($ingr);

			$ingredientes_historico = $controle->selectHistoryByFkIngrediente($ingr["igr_pk_id"]);
			foreach($ingredientes_historico as $key=>$ingr_his){
				$data_alteracao_var = date_create($ingr_his["higr_data"]);
				$data_alteracao = date_format($data_alteracao_var,"d/m/Y H:i:s");
				echo $ingr_his["igr_nome"].' - R$ '.$ingr_his["igr_valor"].' - '.$data_alteracao;
				echo "<br>";
			}
		}
		echo "</td>";
		
			echo "<td style='text-align: center;' name='preco_custo'>R$ ".$ingr["igr_valor"]."</td>
			<td style='text-align: center;' name='valor_extra'>R$ ".$ingr["com_valor_extra"]."</td>
			<td style='text-align: center;' name='valor_total'>R$ ".$ingr["com_valor_extra"]."</td>
			<td style='text-align: center;' name='data_alteracao'>".$ingr_his["higr_data"]."</td>";

		echo "</tr>";
	}
}else{

}
echo "</tbody></table>";

?>