<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."admin/controler/controlCupom.php";
include_once MODELPATH."/cupom.php";
include_once CONTROLLERPATH."/controlUsuario.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlCupom($_SG['link']);

$cupons = $controle->selectAll();


$permissao =  json_decode($usuarioPermissao->getPermissao());	
if ($cupons == -1){
	echo "<h1> SEM RESULTADOS</h1>";
}else{



if(in_array('cupomWpp', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Cupons</h1>
		<tr>
			<th width='10%' style='text-align: center;'>Código Cupom</th>
			<th width='8%' style='text-align: center;'>Código</th>
			<th width='8%' style='text-align: center;'>Quantidade Inicial</th>
			<th width='10%' style='text-align: center;'>Quantidade Atual</th>
			<th width='10%' style='text-align: center;'>Valor</th>
			<th width='8%' style='text-align: center;'>Vencimento</th>
            <th width='15%' style='text-align: center;'>Status</th>
            <th width='15%' style='text-align: center;'>Editar</th>
            <th width='15%' style='text-align: center;'>Cancelar</th>
        </tr>
	<tbody>";


} else{
		echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Cupons</h1>
		<tr>
        <th width='10%' style='text-align: center;'>#Cod_Cupom</th>
        <th width='8%' style='text-align: center;'>Código</th>
        <th width='8%' style='text-align: center;'>Qntd Inicial</th>
        <th width='10%' style='text-align: center;'>Qntd Atual</th>
        <th width='10%' style='text-align: center;'>Valor</th>
        <th width='8%' style='text-align: center;'>Vencimento</th>
        <th width='15%' style='text-align: center;'>Status</th>
        <th width='15%' style='text-align: center;'>Editar</th>
        <th width='15%' style='text-align: center;'>Cancelar</th>
        </tr>
	<tbody>";

	foreach ($cupons as &$cupom) {

		if($cupom->getStatus() == 1){
			$status = "Ativo";
		}else if ($cupom->getStatus() == 2){
			$status = "Esgotado";
		}else if ($cupom->getStatus() == 3 ){
			$status = "Vencido";
		}else if($cupom->getStatus() == 4){
			$status = "Cancelado";
		}else {
			$status = "Status inválido";
		}

		$vencimento = date('d/m/Y', strtotime($cupom->getVencimento()));

			echo "<tr name='resultado' id='status'>
			 	<td style='text-align: center;' name='data'>".$cupom->getCod_cupom()."</td>
			 	<td style='text-align: center;' name='cliente'>".$cupom->getCodigo()."</td>
				<td style='text-align: center;' name='telefone'>".$cupom->getQtde_inicial()."</td>
				<td style='text-align: center;' name='telefone'>".$cupom->getQtde_atual()."</td>
				<td style='text-align: center;' name='valor'>"." R$ ".$cupom->getValor()."</td>
				<td style='text-align: center;' name='valor'>".$vencimento."</td>
				<td style='text-align: center;' name='status'>".$status."</td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='cupom-view.php?cod_cupom=".$cupom->getCod_cupom()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
				<td style='text-align: center;' name='status' ><button type='button' class='btn btn-kionux'><i class='fa fa-remove'></i>Cancelar</button></td>
			</tr>";
	}
}
			}

	echo "</tbody></table>";
	

?>