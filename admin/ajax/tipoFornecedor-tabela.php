<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlTipoFornecedor.php";
include_once MODELPATH."/usuario.php";

protegePagina();

$controle=new controlerTipoFornecedor($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$tipoFornecedor = $controle->selectAll();

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('gerenciar_fornecedor', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Tipos de Fornecedor</h1>
		<tr>
    		<th width='20%' style='text-align: center;'>Tipo de Fornecedor</th>
			<th width='15%' style='text-align: center;'>Status</th>
			<th width='15%' style='text-align: center;'>Editar</th>
			<th width='15%' style='text-align: center;'>Ação</th>
        </tr>
	<tbody>";
	foreach ($tipoForncedores as &$tipoFornecedor) {
        $mensagem='Tipo fornecedor excluído com sucesso!';
	$titulo='Excluir';
	if($tipoFornecedor->getFlag_ativo() == 1){
		$flag = "Ativo";
	}else{
		$flag = "Inativo";
	}
        echo "<tr name='resultado' id='status".$tipoFornecedor->getPkId()."'>
            <td style='text-align: center;' name='nome'>".$tipoFornecedor->getNome()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".$flag."</td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='formaPgt-view.php?cod=".$tipoFornecedor->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";
			
			if($tipoFornecedor->getFlag_ativo() == 1){

				echo "<td style='text-align: center;' name='status'><a href='../../ajax/excluir-formaPgt.php?cod=".$tipoFornecedor->getPkId()."'><button type='button' class='btn btn-kionux'><i class='fa fa-remove'></i> Desativar</button></a></td>";
			
			}else{
			
				echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-formaPgt.php?cod=".$tipoFornecedor->getPkId()."'><button type='button' class='btn btn-kionux' style='width: 107px'><i class='fa fa-check'></i> Ativar</button></a></td>";

			}


		echo "</tr>";
	}
}else{
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Tipo de Fornecedores</h1>
		<tr>
			<th width='20%' style='text-align: center;'>Tipo de Fornecedor</th>
			<th width='15%' style='text-align: center;'>Status</th>
			<th width='15%' style='text-align: center;'>Editar</th>
            <th width='15%' style='text-align: center;'>Apagar</th>
        </tr>
	<tbody>";
	foreach ($tipoForncedores as &$tipoFornecedor) {
        $mensagem='Adicional excluído com sucesso!';
        $titulo='Excluir';
        echo "<tr name='resultado' id='status".$tipoFornecedor->getPkId()."'>
            <td style='text-align: center;' name='nome'>".$tipoFornecedor->getNome()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".($tipoFornecedor->getFlag_ativo() == 1)?"Ativo":"Inativo"."</td> 	
        </tr>";
	}
}
echo "</tbody></table>";

?>