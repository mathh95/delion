<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCombo.php";
include_once MODELPATH."/usuario.php";
protegePagina();
$controle=new controlerCombo($_SG['link']);
$cod_item_combo=$_GET['cod'];
$adicionais = $controle->selectAdicionais($cod_item_combo);
$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('combo', $permissao)){
	if (!($adicionais == -1)){

	
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Adicionais</h1>
		<tr>
    		<th width='33%' style='text-align: center;'>Nome</th>
			<th width='33%' style='text-align: center;'>Preco</th>
			<th width='33%' style='text-align: center;'>Desconto</th>
        </tr>
	<tbody>";
	foreach ($adicionais as &$adicional) {
			echo "
			<tr name='resultado' id='status".$adicional->getCod_adicional()."'>
			 	<td style='text-align: center;' name='produto'>".$adicional->getNome()."</td>
				<td style='text-align: center;' name='valor'>".$adicional->getPreco()."</td>
				<td style='text-align: center;' name='valor'>".$adicional->getDesconto()."%</td>
			</tr>";
	}
	echo "</tbody></table>";
	}else{
		echo "<h1 class\"page-header\" style=\"text-align:center;\">Não possui adicionais</h1>";
	}
}else{
	echo "<h1 class\"page-header\" style=\"text-align:center;\">Não possui permissão</h1>";
}
?>