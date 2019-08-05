<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once MODELPATH."/cliente-wpp.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once HOMEPATH."admin/controler/controlClienteWpp.php";
include_once MODELPATH."/usuario.php";
protegePagina();

$controle=new controlClienteWpp($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

if(isset($_POST['nome'])){ 
	$nome = $_POST['nome'];
	$clientesWpp = $controle->filter($nome);
}else{
	$clientesWpp = $controle->selectAll();
}
$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('pedidoWpp', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
        <h1 class=\"page-header\">Lista de Clientes Whatsapp</h1>
        <div class=\"pull-right\"> 
            <a href=\"pedidoWpp.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
        </div class=\"pull-right\">
		<tr>
    		<th width='20%' style='text-align: center;'>Nome</th>
            <th width='15%' style='text-align: center;'>Telefone</th>
            <th width='15%' style='text-align: center;'>Rua</th>
            <th width='15%' style='text-align: center;'>Numero</th>
            <th width='15%' style='text-align: center;'>Bairro</th>
            <th width='15%' style='text-align: center;'>Complemento</th>
        </tr>
	<tbody>";
	foreach ($clientesWpp as &$clienteWpp) {
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$clienteWpp->getCod_cliente_wpp()."'>
			 	<td style='text-align: center;' name='nome'>".$clienteWpp->getNome()."</td>
			 	<td style='text-align: center;' name='login'>".$clienteWpp->getTelefone()."</td>
			 	<td style='text-align: center;' name='login'>".$clienteWpp->getRua()."</td>
			 	<td style='text-align: center;' name='login'>".$clienteWpp->getNumero()."</td>
			 	<td style='text-align: center;' name='login'>".$clienteWpp->getBairro()."</td>
			 	<td style='text-align: center;' name='login'>".$clienteWpp->getComplemento()."</td>
			</tr>";
	}
}else{
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
        <h1 class=\"page-header\">Lista de Clientes Whatsapp</h1>
        <div class=\"pull-right\">
            <a href=\"pedidoWpp.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
        </div class=\"pull-right\">
        <tr>
            <th width='20%' style='text-align: center;'>Nome</th>
            <th width='15%' style='text-align: center;'>Telefone</th>
            <th width='15%' style='text-align: center;'>Rua</th>
            <th width='15%' style='text-align: center;'>Numero</th>
            <th width='15%' style='text-align: center;'>Bairro</th>
            <th width='15%' style='text-align: center;'>Complemento</th>
        </tr>
	<tbody>";
	foreach ($clientesWpp as &$clienteWpp) {
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$clienteWpp->getCod_cliente_wpp()."'>
			 	<td style='text-align: center;' name='nome'>".$clienteWpp->getNome()."</td>
                <td style='text-align: center;' name='perfil'>".$clienteWpp->getTelefone()."</td>
                <td style='text-align: center;' name='login'>".$clienteWpp->getRua()."</td>
                <td style='text-align: center;' name='login'>".$clienteWpp->getNumero()."</td>
                <td style='text-align: center;' name='login'>".$clienteWpp->getBairro()."</td>
                <td style='text-align: center;' name='login'>".$clienteWpp->getComplemento()."</td>  	
			</tr>";
}
echo "</tbody></table>";
}
?>