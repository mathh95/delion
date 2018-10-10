<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCombo.php";
include_once MODELPATH."/usuario.php";
protegePagina();

$controle=new controlerCombo($_SG['link']);

$combos = $controle->selectAllCombo();
$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('combo', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Combos</h1>
		<tr>
            <th width='20%' style='text-align: center;'>Data</th>
			<th width='15%' style='text-align: center;'>Nome do cliente</th>
			<th width='20%' style='text-align: center;'>Telefone do cliente</th>
			<th width='15%' style='text-align: center;'>Valor total</th>
			<th width='15%' style='text-align: center;'>Lista de itens</th>
        </tr>
	<tbody>";
	foreach ($combos as &$combo) {
			$mensagem='Combo excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$combo->getCod_combo()."'>
                <td style='text-align: center;' name='data'>".$combo->getData()->format('d/m/Y')."</td>
			 	<td style='text-align: center;' name='cliente'>".$combo->getCliente()."</td>
				<td style='text-align: center;' name='telefone'>".$combo->telefone."</td>
				<td style='text-align: center;' name='valor'>".$combo->getValor()."</td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='itemLista.php?cod=".$combo->getCod_combo()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Itens</button></a></td>
			</tr>";
	}
} else{
		echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
            <th width='25%' style='text-align: center;'>Data</th>
			<th width='15%' style='text-align: center;'>Nome do cliente</th>
			<th width='30%' style='text-align: center;'>Telefone do cliente</th>
			<th width='15%' style='text-align: center;'>Valor total</th>
        </tr>
	<tbody>";
	foreach ($combos as &$combo) {
			$mensagem='Combo excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$combo->getCod_combo()."'>
                <td style='text-align: center;' name='data'>".$combo->getData()->format('d/m/Y')."</td>
			 	<td style='text-align: center;' name='cliente'>".$combo->getCliente()."</td>
				<td style='text-align: center;' name='telefone'>".$combo->telefone."</td>
				<td style='text-align: center;' name='valor'>".$combo->getValor()."</td>
			</tr>";
	}
}
echo "</tbody></table>";

?>