<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once HOMEPATH."home/controler/controlCliente.php";
include_once MODELPATH."/usuario.php";
protegePagina();

include_once HELPERPATH."/mask.php";
$mask = new Mask;

$controle = new controlCliente($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

if(isset($_POST['nome'])){ 
	$nome = $_POST['nome'];
	$clientes = $controle->filter($nome);
}else{
	$clientes = $controle->selectAll();
}

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('cliente', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 >Lista de Clientes</h1>";

		if($clientes != -1){
			echo "<tr>
					<th width='20%' style='text-align: center;'>Nome</th>
					<th width='15%' style='text-align: center;'>Login</th>
					<th width='15%' style='text-align: center;'>Telefone</th>
					<th width='15%' style='text-align: center;'>Status</th>
					<th width='15%' style='text-align: center;'>Editar</th>
					<th width='15%' style='text-align: center;'>Apagar</th>
				</tr>
			<tbody>";
		foreach ($clientes as &$cliente) {

		$masked_phone = $mask->addMaskPhone($cliente->getTelefone());

		if($cliente->getStatus()==1){
			$status = "Ativo";
		}else{
			$status = "Desativado";
		}

		echo "<tr name='resultado' id='status".$cliente->getPkId()."'>
			<td style='text-align: center;' name='nome'>".$cliente->getNome()."</td>
			<td style='text-align: center;' name='login'>".$cliente->getLogin()."</td>
			<td style='text-align: center;' name='telefone'>".$masked_phone."</td>
			<td style='text-align: center;' name='telefone'>".$status."</td>
			<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='cliente-view.php?cod=".$cliente->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
			<td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$cliente->getPkId().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>&nbsp;Desativar</button></td>
		</tr>";
		}
	}else{
		echo "<h4>SEM RESULTADOS 😕</h4>";		
	}
}else{
	echo "<h3>SEM PERMISSÃO 😕</h3>";
}
echo "</tbody></table>";


?>