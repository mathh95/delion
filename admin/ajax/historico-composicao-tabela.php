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

$composicoes = $controle->selectHistorico();
// $selectFkComposicao = $controle->selectByFkComposicao();


// var_dump($composicoes);
// exit;

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('gerenciar_composicao', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1>Historico de Produtos</h1>
		<tr>
		<th width='15%' style='text-align: center;'>#ID</th>
            <th width='20%' style='text-align: center;'>Nome do Produto</th>
			<th width='20%' style='text-align: center;'>Ingredientes</th>
			<th width='15%' style='text-align: center;'>Valor</th>
			<th width='15%' style='text-align: center;'>Data</th>
        </tr>
	<tbody>";

	foreach ($composicoes as $key=>$composicao) {
		$soma_valores = $controle->sumValorTotal($composicao->getPkId());
		$soma_valores_format =(number_format($soma_valores[0]["soma_valores"], 2, '.', ''));
		//Segundo select selectByFkComposicao
		$selectHistory_var = $controle->selectHistory($composicao->getPkId());
		// $selectFkComposicao_format = ($selectFkComposicao[0]["coig_fk_ingrediente"]);
		var_dump($selectHistory_var[$key]);
		// exit;


        $mensagem='Preço de custo excluído com sucesso!';
	$titulo='Excluir';
        echo "<tr name='resultado' id='status".$composicao->getPkId()."'>
            <td style='text-align: center;' name='id'>".$composicao->getPkId()."</td>
			<td style='text-align: center;' name='nome'>".$composicao->nome_prod."</td>
            <td style='text-align: center;' name='ingredientes'>".$selectHistory_var[$key]["igr_nome"]."</td>
			<td style='text-align: center;' name='valor'>R$ ".$selectHistory_var[$key]["higr_valor"]."</td>
			<td style='text-align: center;' name='valorExtra'>".$selectHistory_var[$key]["higr_data"]."</td>";

		echo "</tr>";
	}
}else{

}
echo "</tbody></table>";

?>