<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once HOMEPATH."home/controler/controlCliente.php";
include_once MODELPATH."/usuario.php";
protegePagina();

$controle=new controlCliente($_SG['link']);
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
		<h1 class=\"page-header\">Lista de Clientes</h1>
		<tr>
    		<th width='20%' style='text-align: center;'>Nome</th>
    		<th width='15%' style='text-align: center;'>Login</th>
    		<th width='15%' style='text-align: center;'>Telefone</th>
            <th width='15%' style='text-align: center;'>Editar</th>
            <th width='15%' style='text-align: center;'>Apagar</th>
        </tr>
	<tbody>";
	foreach ($clientes as &$cliente) {

		$masked_phone = masc_phone($cliente->getTelefone());


		if($cliente->getStatus()==1){
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$cliente->getCod_cliente()."'>
			 	<td style='text-align: center;' name='nome'>".$cliente->getNome()."</td>
			 	<td style='text-align: center;' name='login'>".$cliente->getLogin()."</td>
			 	<td style='text-align: center;' name='telefone'>".$masked_phone."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='cliente-view.php?cod=".$cliente->getCod_cliente()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
			 	<td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$cliente->getCod_cliente().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>&nbsp;Desativar</button></td>
			</tr>";
		}
	}
}else{
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Clientes</h1>
		<tr>
    		<th width='33%' style='text-align: center;'>Nome</th>
    		<th width='33%' style='text-align: center;'>Login</th>
    		<th width='33%' style='text-align: center;'>Telefone</th>
        </tr>
	<tbody>";
	foreach ($clientes as &$cliente) {
		if($cliente->getStatus()==1){
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$cliente->getCod_cliente()."'>
			 	<td style='text-align: center;' name='nome'>".$cliente->getNome()."</td>
			 	<td style='text-align: center;' name='login'>".$cliente->getLogin()."</td>
			 	<td style='text-align: center;' name='perfil'>".$cliente->getTelefone()."</td> 	
			</tr>";
		}
}
echo "</tbody></table>";
}

function masc_phone($phone) {
	
	$tam = strlen(preg_replace("/[^0-9]/", "", $phone));
	
	if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
		return "+".substr($phone,0,$tam-11)."(".substr($phone,$tam-11,2).") ".substr($phone,$tam-9,5)."-".substr($phone,-4);
	}
	if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
		return "+".substr($phone,0,$tam-10)."(".substr($phone,$tam-10,2).") ".substr($phone,$tam-8,4)."-".substr($phone,-4);
	}
	if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
		return "(".substr($phone,0,2).") ".substr($phone,2,5)."-".substr($phone,7,11);
	}
	if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
		return "(".substr($phone,0,2).") ".substr($phone,2,4)."-".substr($phone,6,10);
	}
	if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
		return substr($phone,0,$tam-4)."-".substr($phone,-4);
	}
}

?>