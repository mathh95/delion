<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlPrecoDeCusto.php";
include_once MODELPATH."/usuario.php";

protegePagina();

$controle=new controlerPrecoDeCusto($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$preco_custo = $controle->selectAll();

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('gerenciar_composicao', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Produtos a preço de custo</h1>
		<tr>
    		<th width='20%' style='text-align: center;'>Nome do Produto</th>
			<th width='15%' style='text-align: center;'>Ingredientes</th>
			<th width='15%' style='text-align: center;'>Editar</th>
			<th width='15%' style='text-align: center;'>Ação</th>
        </tr>
	<tbody>";
	foreach ($precos_custo as &$preco_custo) {
        $mensagem='Preço de custo excluído com sucesso!';
	$titulo='Excluir';
	// if($tipo_fornecedor->getFlag_ativo() == 1){
	// 	$flag = "Ativo";
	// }else{
	// 	$flag = "Inativo";
	// }
        echo "<tr name='resultado' id='status".$preco_custo->getPkId()."'>
            <td style='text-align: center;' name='nome'>".$preco_custo->getNome()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".$preco_custo->getIngredientes()."</td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='tipoFornecedor-view.php?cod=".$preco_custo->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";
			
			// if($tipo_fornecedor->getFlag_ativo() == 1){

			// 	echo "<td style='text-align: center;' name='status'><a href='../../ajax/excluir-tipoFornecedor.php?cod=".$tipo_fornecedor->getPkId()."'><button type='button' class='btn btn-kionux'><i class='fa fa-remove'></i> Desativar</button></a></td>";
			
			// }else{
			
			// 	echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-tipoFornecedor.php?cod=".$tipo_fornecedor->getPkId()."'><button type='button' class='btn btn-kionux' style='width: 107px'><i class='fa fa-check'></i> Ativar</button></a></td>";

			// }


		echo "</tr>";
	}
}else{
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Preço de custo</h1>
		<tr>
			<th width='20%' style='text-align: center;'>Nome do Produto</th>
			<th width='15%' style='text-align: center;'>Ingredientes</th>
			<th width='15%' style='text-align: center;'>Editar</th>
            <th width='15%' style='text-align: center;'>Apagar</th>
        </tr>
	<tbody>";
	foreach ($precos_custo as &$preco_custo) {
        $mensagem='Adicional excluído com sucesso!';
        $titulo='Excluir';
        echo "<tr name='resultado' id='status".$preco_custo->getPkId()."'>
            <td style='text-align: center;' name='nome'>".$preco_custo->getNome()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".$preco_custo->getIngredientes()."</td> 	
        </tr>";
	}
}
echo "</tbody></table>";

?>