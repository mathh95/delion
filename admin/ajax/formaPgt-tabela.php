<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlFormaPgt.php";
include_once MODELPATH."/usuario.php";

protegePagina();

$controle=new controlerFormaPgt($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$formaPgts = $controle->selectAll();

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('forma_pgto', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Formas de Pagamento</h1>
		<tr>
    		<th width='20%' style='text-align: center;'>Tipo Forma de Pagamento</th>
			<th width='15%' style='text-align: center;'>Status</th>
			<th width='15%' style='text-align: center;'>Editar</th>
			<th width='15%' style='text-align: center;'>Ação</th>
        </tr>
	<tbody>";
	foreach ($formaPgts as &$formaPgt) {
        $mensagem='Adicional excluído com sucesso!';
	$titulo='Excluir';
	if($formaPgt->getFlag_ativo() == 1){
		$flag = "Ativo";
	}else{
		$flag = "Inativo";
	}
        echo "<tr name='resultado' id='status".$formaPgt->getPkId()."'>
            <td style='text-align: center;' name='nome'>".$formaPgt->getNome()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".$flag."</td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='formaPgt-view.php?cod=".$formaPgt->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>";
			
			if($formaPgt->getFlag_ativo() == 1){

				echo "<td style='text-align: center;' name='status'><a href='../../ajax/excluir-formaPgt.php?cod=".$formaPgt->getPkId()."'><button type='button' class='btn btn-kionux'><i class='fa fa-remove'></i> Desativar</button></a></td>";
			
			}else{
			
				echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-formaPgt.php?cod=".$formaPgt->getPkId()."'><button type='button' class='btn btn-kionux' style='width: 107px'><i class='fa fa-check'></i> Ativar</button></a></td>";

			}


		echo "</tr>";
	}
}else{
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Adicionais</h1>
		<tr>
			<th width='20%' style='text-align: center;'>Tipo Forma de Pagamento</th>
			<th width='15%' style='text-align: center;'>Status</th>
			<th width='15%' style='text-align: center;'>Editar</th>
            <th width='15%' style='text-align: center;'>Apagar</th>
        </tr>
	<tbody>";
	foreach ($formaPgts as &$formaPgt) {
        $mensagem='Adicional excluído com sucesso!';
        $titulo='Excluir';
        echo "<tr name='resultado' id='status".$formaPgt->getPkId()."'>
            <td style='text-align: center;' name='nome'>".$formaPgt->getNome()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".($formaPgt->getFlag_ativo() == 1)?"Ativo":"Inativo"."</td> 	
        </tr>";
	}
}
echo "</tbody></table>";

?>