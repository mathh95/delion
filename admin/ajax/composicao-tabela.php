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
		<h1 >Lista de Produtos</h1>
		<tr>
		<th width='15%' style='text-align: center;'>#ID</th>
    		<th width='20%' style='text-align: center;'>Nome do Produto</th>
			<th width='15%' style='text-align: center;'>Preço de Custo Total</th>
			<th width='15%' style='text-align: center;'>Valor Extra</th>
			<th width='15%' style='text-align: center;'>Detalhes</th>
			<th width='15%' style='text-align: center;'>Editar</th>
        </tr>
	<tbody>";
	var_dump($composicoes);
	exit;
	foreach ($composicoes as $composicao) {
		$valor_ingrediente = $composicao->qtd_ing*$composicao->valor_ingrediente;
		
		

        $mensagem='Preço de custo excluído com sucesso!';
		$titulo='Excluir';
        echo "<tr name='resultado' id='status".$composicao->getPkId()."'>
            <td style='text-align: center;' name='id'>".$composicao->getPkId()."</td>
			<td style='text-align: center;' name='nome'>".$composicao->nome_prod."</td>
			<td style='text-align: center;' name='valor'>R$ ".$valor_total."</td>
			<td style='text-align: center;' name='valorExtra'>R$ ".$composicao->getValorExtra()."</td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='composicaoDetalhes.php?cod=".$composicao->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Detalhes</button></a></td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='tipoFornecedor-view.php?cod=".$composicao->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";

		echo "</tr>";
	}
}else{

}
echo "</tbody></table>";

?>