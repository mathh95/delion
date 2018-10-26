<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCombo.php";
include_once MODELPATH."/usuario.php";
protegePagina();
$controle=new controlerCombo($_SG['link']);
$cod_combo=$_GET['cod'];
$itens = $controle->selectItens($cod_combo);
$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('combo', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Itens</h1>
		<tr>
    		<th width='33%' style='text-align: center;'>Produto</th>
			<th width='33%' style='text-align: center;'>Valor</th>
			<th width='33%' style='text-align: center;'>Adicionais</th>
        </tr>
	<tbody>";
	foreach ($itens as &$item) {
			echo "
			<tr name='resultado' id='status".$item->getCod_item_combo()."'>
			 	<td style='text-align: center;' name='produto'>".$item->getProduto()."</td>
				<td style='text-align: center;' name='valor'>".$item->preco."</td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='itemListaAdicionais.php?cod=".$item->getCod_item_combo()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Adicionais</button></a></td>
			</tr>";
	}
	echo "</tbody></table>";
}else{
	echo "<h1 class\"page-header\" style=\"text-align:center;\">Não possui permissão</h1>";
}
?>