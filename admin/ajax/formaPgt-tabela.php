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
if(in_array('adicional', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Formas de Pagamento</h1>
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
	if($formaPgt->getFlag_ativo() == 1){
		$flag = "Ativo";
	}else{
		$flag = "Inativo";
	}
        echo "<tr name='resultado' id='status".$formaPgt->getCod_formaPgt()."'>
            <td style='text-align: center;' name='nome'>".$formaPgt->getTipoFormaPgt()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".$flag."</td>
            <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='formaPgt-view.php?cod=".$formaPgt->getCod_formaPgt()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
            <td style='text-align: center;' name='status'><button type='button' onclick=\"removeFormaPgt(".$formaPgt->getCod_formaPgt().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>Excluir</button></a></td>
        </tr>";
	}
}else{
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Adicionais</h1>
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
        echo "<tr name='resultado' id='status".$formaPgt->getCod_formaPgt()."'>
            <td style='text-align: center;' name='nome'>".$formaPgt->getTipoFormaPgt()."</td>
	    <td style='text-align: center;' name='flag_ativo'>".($formaPgt->getFlag_ativo() == 1)?"Ativo":"Inativo"."</td> 	
        </tr>";
}
echo "</tbody></table>";
}
?>